<?php

namespace App\Livewire;

use App\Models\Content;
use App\Models\Media;
use Livewire\Component;
use Livewire\WithPagination;

class GalleryFilter extends Component
{
    use WithPagination;

    public string $filter = 'all'; // 'all' | content type slug

    public int $perPage = 24;

    public function setFilter(string $filter): void
    {
        $this->filter = $filter;
        $this->resetPage();
    }

    public function render(): \Illuminate\View\View
    {
        $query = Media::where('file_type', 'like', 'image/%')
            ->where('mediable_type', 'App\Models\Content')
            ->with('mediable')
            ->latest();

        if ($this->filter !== 'all') {
            $query->whereHasMorph('mediable', Content::class, function ($q) {
                $q->where('type', $this->filter);
            });
        }

        return view('livewire.gallery-filter', [
            'images' => $query->paginate($this->perPage),
        ]);
    }
}
