<div class="gallery-component">

    {{-- Filter tabs --}}
    <div class="filter-tabs">
        @foreach(['all' => 'All', 'project' => 'Projects', 'event' => 'Events', 'blog' => 'Blog'] as $val => $label)
        <button wire:click="setFilter('{{ $val }}')"
                class="filter-tab {{ $filter === $val ? 'active' : '' }}">
            {{ $label }}
        </button>
        @endforeach
    </div>

    {{-- Loading state --}}
    <div wire:loading class="gallery-loading">Loading...</div>

    {{-- Grid --}}
    <div class="gallery-grid" wire:loading.class="opacity-50">
        @forelse($images as $image)
        <div class="gallery-item"
             x-data="{ open: false }"
             @click="open = true">
            <img src="{{ Storage::url($image->file_path) }}"
                 alt="{{ $image->alt_text ?? 'KWDT community photo' }}"
                 loading="lazy">
            @if($image->alt_text)
            <div class="gallery-caption">{{ $image->alt_text }}</div>
            @endif

            {{-- Lightbox --}}
            <div x-show="open"
                 x-transition
                 @click.self="open = false"
                 class="lightbox"
                 style="display:none;">
                <button @click="open = false" class="lightbox-close">✕</button>
                <img src="{{ Storage::url($image->file_path) }}"
                     alt="{{ $image->alt_text ?? '' }}">
                @if($image->alt_text)
                <p class="lightbox-caption">{{ $image->alt_text }}</p>
                @endif
            </div>
        </div>
        @empty
        <div class="empty-state col-span-full">
            <p>No photos in this category yet.</p>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($images->hasPages())
    <div class="pagination-wrap">
        {{ $images->links() }}
    </div>
    @endif

</div>
