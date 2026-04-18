@props(['post'])

<a href="{{ route('blog.show', $post->slug) }}" class="blog-card reveal group">
    <div class="blog-img relative">
        @if($post->featured_image)
            <img src="{{ $post->featured_image }}"
                 alt="{{ $post->title }}"
                 class="transition-transform duration-500 group-hover:scale-105">
        @else
            <div class="blog-img-placeholder"></div>
        @endif

        {{-- Category chip on image instead of below it --}}
        <span class="blog-category absolute top-3 left-3 m-0"
              style="backdrop-filter:blur(6px);
                     background:rgba(26,20,16,.65);
                     color:rgba(253,250,246,.88);
                     border-radius:999px;
                     padding:.25rem .75rem">
            {{ $post->categories->first()?->name ?? 'News' }}
        </span>
    </div>

    <h3 class="group-hover:text-orange transition-colors duration-200"
        style="transition-property:color">
        {{ $post->title }}
    </h3>

    @if($post->excerpt)
        <p>{{ Str::limit($post->excerpt, 120) }}</p>
    @endif

    <div class="flex items-center justify-between mt-auto pt-3"
         style="border-top:1px solid var(--cream-dark); margin-top:auto">
        <span class="blog-date" style="margin:0">
            {{ $post->published_at->format('M d, Y') }}
        </span>
        <span class="flex items-center gap-1 text-xs font-semibold
                     transition-all duration-200 group-hover:gap-2"
              style="color:var(--orange); font-size:.78rem">
            Read
            <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:translate-x-0.5"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </span>
    </div>
</a>