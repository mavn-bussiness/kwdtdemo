<?php

namespace App\Livewire;

use App\Models\Content;
use App\Models\Media;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class GalleryFilter extends Component
{
    use WithPagination;

    public string $filter = 'all';

    public int $perPage = 24;

    protected $queryString = ['filter']; // This syncs the filter with the URL

    public function setFilter(string $filter): void
    {
        $this->filter = $filter;
        $this->resetPage();
    }

    public function render(): View
    {
        $cacheKey = 'gallery_filter_'.$this->filter.'_page_'.$this->getPage();

        $images = cache()->remember($cacheKey, now()->addMinutes(10), function () {
            $query = Media::where('file_type', 'like', 'image/%')
                ->where('mediable_type', 'App\Models\Content')
                ->with('mediable')
                ->latest();

            if ($this->filter !== 'all') {
                $query->whereHasMorph('mediable', Content::class, function ($q) {
                    $q->where('type', $this->filter);
                });
            }

            return $query->paginate($this->perPage);
        });

        return view('livewire.gallery-filter', [
            'images' => $images,
        ]);
    }

    // Reset pagination when filter changes
    public function updatedFilter()
    {
        $this->resetPage();
    }
}
