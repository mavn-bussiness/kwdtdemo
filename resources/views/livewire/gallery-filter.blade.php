<div class="gallery-component">
    {{-- Filter tabs with icons --}}
    <div class="flex flex-wrap gap-2 mb-8">
        <button wire:click="setFilter('all')"
                class="flex items-center gap-2 px-5 py-2.5 rounded-full border-2 transition-all
                       {{ $filter === 'all'
                           ? 'border-orange bg-orange text-white'
                           : 'border-cream-dark hover:border-orange/50' }}">
            <x-icon name="heart" class="w-4 h-4" />
            All
        </button>
        <button wire:click="setFilter('project')"
                class="flex items-center gap-2 px-5 py-2.5 rounded-full border-2 transition-all
                       {{ $filter === 'project'
                           ? 'border-orange bg-orange text-white'
                           : 'border-cream-dark hover:border-orange/50' }}">
            <x-icon name="camera" class="w-4 h-4" />
            Projects
        </button>
        <button wire:click="setFilter('event')"
                class="flex items-center gap-2 px-5 py-2.5 rounded-full border-2 transition-all
                       {{ $filter === 'event'
                           ? 'border-orange bg-orange text-white'
                           : 'border-cream-dark hover:border-orange/50' }}">
            <x-icon name="calendar" class="w-4 h-4" />
            Events
        </button>
        <button wire:click="setFilter('blog')"
                class="flex items-center gap-2 px-5 py-2.5 rounded-full border-2 transition-all
                       {{ $filter === 'blog'
                           ? 'border-orange bg-orange text-white'
                           : 'border-cream-dark hover:border-orange/50' }}">
            <x-icon name="envelope" class="w-4 h-4" />
            Blog
        </button>
    </div>

    {{-- Loading state --}}
    <div wire:loading class="text-center py-4">
        <svg class="animate-spin h-8 w-8 text-orange mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
        </svg>
    </div>

    {{-- Grid --}}
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" wire:loading.class="opacity-50">
        @forelse($images as $image)
            <div class="gallery-item relative group cursor-pointer rounded-xl overflow-hidden aspect-square"
                 x-data="{ open: false }"
                 @click="open = true">
                <img src="{{ Storage::url($image->file_path) }}"
                     alt="{{ $image->alt_text ?? 'KWDT community photo' }}"
                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                     loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                    @if($image->alt_text)
                        <p class="text-white text-sm font-medium">{{ $image->alt_text }}</p>
                    @endif
                </div>

                {{-- Lightbox --}}
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     @click.self="open = false"
                     class="fixed inset-0 z-50 bg-black/90 flex items-center justify-center p-4"
                     style="display: none;">
                    <button @click="open = false" class="absolute top-4 right-4 text-white hover:text-orange transition-colors">
                        <x-icon name="x-mark" class="w-8 h-8" />
                    </button>
                    <img src="{{ Storage::url($image->file_path) }}"
                         alt="{{ $image->alt_text ?? '' }}"
                         class="max-h-[90vh] max-w-[90vw] object-contain rounded-lg">
                    @if($image->alt_text)
                        <p class="absolute bottom-4 left-1/2 -translate-x-1/2 text-white bg-black/50 px-4 py-2 rounded-full text-sm">
                            {{ $image->alt_text }}
                        </p>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 bg-cream rounded-2xl">
                <x-icon name="camera" class="w-16 h-16 text-earth-muted mx-auto mb-4" />
                <p class="text-earth-muted text-lg">No photos in this category yet.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($images->hasPages())
        <div class="mt-8">
            {{ $images->links() }}
        </div>
    @endif
</div>
