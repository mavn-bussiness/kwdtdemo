<?php

namespace App\Livewire;

use App\Models\Award;
use App\Models\Content;
use App\Models\Media;
use App\Models\Partner;
use App\Models\TeamMember;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class GalleryFilter extends Component
{
    use WithPagination;

    public string $filter = 'all';

    public int $perPage = 24;

    protected $queryString = ['filter'];

    public function setFilter(string $filter): void
    {
        $this->filter = $filter;
        $this->resetPage();
    }

    public function render(): View
    {
        $cacheKey = 'gallery_filter_'.$this->filter.'_page_'.$this->getPage().'_per_'.$this->perPage;

        $images = cache()->remember($cacheKey, now()->addMinutes(10), function () {
            return $this->buildGalleryItems();
        });

        return view('livewire.gallery-filter', ['images' => $images]);
    }

    private function buildGalleryItems(): \Illuminate\Pagination\LengthAwarePaginator
    {
        $items = collect();

        // 1. Media table (uploaded files linked to any model)
        $mediaQuery = Media::where('file_type', 'like', 'image/%');

        if ($this->filter !== 'all') {
            $mediaQuery->where('mediable_type', Content::class)
                ->whereHasMorph('mediable', Content::class, fn ($q) => $q->where('type', $this->filter));
        }

        $mediaQuery->latest()->get()->each(function ($m) use ($items) {
            $items->push([
                'src'   => $m->url(),
                'alt'   => $m->alt_text ?? $m->file_name,
                'label' => null,
            ]);
        });

        // 2. Content featured_image (blog, news, event, project, report)
        if (in_array($this->filter, ['all', 'news', 'event', 'project', 'blog', 'report'])) {
            $contentQuery = Content::whereNotNull('featured_image')
                ->where('featured_image', '!=', '')
                ->where('status', 'published');

            if ($this->filter !== 'all') {
                $contentQuery->where('type', $this->filter);
            }

            $contentQuery->latest('published_at')->get()->each(function ($c) use ($items) {
                $items->push([
                    'src'   => \Illuminate\Support\Facades\Storage::url($c->featured_image),
                    'alt'   => $c->title,
                    'label' => $c->title,
                ]);
            });
        }

        // 3. Team member photos (only on 'all' filter)
        if ($this->filter === 'all') {
            TeamMember::active()->whereNotNull('photo_url')->where('photo_url', '!=', '')->get()
                ->each(fn ($t) => $items->push([
                    'src'   => \Illuminate\Support\Facades\Storage::url($t->photo_url),
                    'alt'   => $t->name,
                    'label' => $t->name,
                ]));

            // 4. Award images
            Award::whereNotNull('image_url')->where('image_url', '!=', '')->orderBy('order')->get()
                ->each(fn ($a) => $items->push([
                    'src'   => \Illuminate\Support\Facades\Storage::url($a->image_url),
                    'alt'   => $a->title,
                    'label' => $a->title,
                ]));
        }

        // Paginate the merged collection
        $page    = $this->getPage();
        $total   = $items->count();
        $sliced  = $items->slice(($page - 1) * $this->perPage, $this->perPage)->values();

        return new \Illuminate\Pagination\LengthAwarePaginator(
            $sliced, $total, $this->perPage, $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }

    public function updatedFilter(): void
    {
        $this->resetPage();
    }
}
