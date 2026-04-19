<div>
    {{-- Filter bar --}}
    <div class="news-filter-bar" style="position:static; box-shadow:none; margin-bottom:2rem;">
        <div class="news-filter-inner" style="max-width:none; justify-content:center;">
            @foreach(['all' => 'All', 'news' => 'News', 'event' => 'Events', 'project' => 'Projects', 'blog' => 'Blog'] as $value => $label)
                <button
                    wire:click="setFilter('{{ $value }}')"
                    class="news-filter-tab {{ $filter === $value ? 'active' : '' }}">
                    {{ $label }}
                </button>
            @endforeach
        </div>
    </div>

    {{-- Image grid --}}
    @if($images->isEmpty())
        <p style="text-align:center; color:var(--earth-muted); padding:4rem 0;">No images found.</p>
    @else
        <div class="gallery-grid">
            @foreach($images as $image)
                <div class="gallery-item">
                    <img
                        src="{{ $image['src'] }}"
                        alt="{{ $image['alt'] }}"
                        loading="lazy">
                    @if(!empty($image['label']))
                        <span class="gallery-item-label">{{ $image['label'] }}</span>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="pagination-wrap">
            {{ $images->links('vendor.pagination.kwdt') }}
        </div>
    @endif
</div>
