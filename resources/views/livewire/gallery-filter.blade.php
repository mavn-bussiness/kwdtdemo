<div>
    {{-- Filter buttons --}}
    <div class="flex gap-3 justify-center mb-8">
        @foreach(['all' => 'All', 'news' => 'News', 'event' => 'Events', 'project' => 'Projects'] as $value => $label)
            <button
                wire:click="setFilter('{{ $value }}')"
                class="px-4 py-2 rounded {{ $filter === $value ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700' }}">
                {{ $label }}
            </button>
        @endforeach
    </div>

    {{-- Image grid --}}
    @if($images->isEmpty())
        <p class="text-center text-gray-500 py-16">No images found.</p>
    @else
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($images as $image)
                <div class="aspect-square overflow-hidden rounded-lg">
                    <img
                        src="{{ $image->url() }}"
                        alt="{{ $image->alt_text ?? $image->file_name }}"
                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                        loading="lazy">
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $images->links() }}
        </div>
    @endif
</div>
