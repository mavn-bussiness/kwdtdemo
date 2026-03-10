<x-layouts.app :title="$post->title" :metaDescription="$post->excerpt">

    {{-- ── Post title header (above image, like Red Cross) ─── --}}
    <div class="show-title-bar">
        <div class="show-title-inner">
            <a href="{{ route('blog.index') }}" class="show-back-link">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="15 18 9 12 15 6"/></svg>
                Back to Blog
            </a>
            <h1 class="show-title">{{ $post->title }}</h1>
        </div>
    </div>

    {{-- ── Two-column layout ──────────────────────────────────── --}}
    <div class="show-layout">

        {{-- ════ LEFT: article ════ --}}
        <article class="show-main">

            {{-- Featured image --}}
            @if($post->featured_image)
                <div class="show-featured-img reveal">
                    <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" loading="eager">
                </div>
            @endif

            {{-- Post meta bar --}}
            <div class="show-meta reveal">
                <span class="show-meta-item">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    {{ $post->published_at->format('F j, Y') }}
                </span>
                <span class="show-meta-sep" aria-hidden="true">·</span>
                <span class="show-meta-item">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M20 14.66V20a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2h5.34"/><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"/></svg>
                    {{ $post->categories->first()?->name ?? 'News' }}
                </span>
                <span class="show-meta-sep" aria-hidden="true">·</span>
                <span class="show-meta-item">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    {{ $post->author?->name ?? 'KWDT' }}
                </span>
            </div>

            {{-- Post body --}}
            <div class="show-body reveal">
                {!! $post->body !!}
            </div>

            {{-- Tags row --}}
            @if($post->categories->count())
                <div class="show-tags-row reveal">
                    <span class="show-tags-label">Tags :</span>
                    @foreach($post->categories as $cat)
                        <a href="{{ route('blog.index', ['category' => $cat->slug]) }}"
                           class="show-tag-pill">{{ $cat->name }}</a>
                    @endforeach

                    <span class="show-share-label">Share :</span>
                    <div class="show-share-icons">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                           target="_blank" rel="noopener" class="show-share-icon" aria-label="Share on Facebook">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}"
                           target="_blank" rel="noopener" class="show-share-icon" aria-label="Share on X / Twitter">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}"
                           target="_blank" rel="noopener" class="show-share-icon" aria-label="Share on LinkedIn">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg>
                        </a>
                    </div>
                </div>
            @endif

            {{-- Image gallery --}}
            @php
                $galleryImages = $post->media->filter(fn($m) => str_starts_with($m->file_type ?? '', 'image/'));
            @endphp
            @if($galleryImages->count())
                <div class="show-gallery reveal">
                    @foreach($galleryImages as $img)
                        <div class="gallery-item">
                            <img src="{{ Storage::url($img->file_path) }}"
                                 alt="{{ $img->alt_text ?? $post->title }}"
                                 loading="lazy">
                        </div>
                    @endforeach
                </div>
            @endif

        </article>

        {{-- ════ RIGHT: sidebar ════ --}}
        <aside class="news-sidebar">

            {{-- Search --}}
            <div class="sidebar-widget">
                <form action="{{ route('blog.index') }}" method="GET" class="sidebar-search-form">
                    <input type="text" name="q" value="{{ request('q') }}"
                           placeholder="Search articles..." class="sidebar-search-input" aria-label="Search articles">
                    <button type="submit" class="sidebar-search-btn" aria-label="Search">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    </button>
                </form>
            </div>

            {{-- Recent News --}}
            @if($recent->isNotEmpty())
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Recent News</h3>
                    <div class="sidebar-recent-list">
                        @foreach($recent as $item)
                            <a href="{{ route('blog.show', $item->slug) }}" class="sidebar-recent-item">
                                <div class="sidebar-recent-img">
                                    @if($item->featured_image)
                                        <img src="{{ $item->featured_image }}" alt="{{ $item->title }}" loading="lazy">
                                    @else
                                        <div class="sidebar-recent-img-placeholder"></div>
                                    @endif
                                </div>
                                <div class="sidebar-recent-body">
                                    <span class="sidebar-recent-date">
                                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                        {{ $item->published_at->format('M j, Y') }}
                                    </span>
                                    <p class="sidebar-recent-title">{{ Str::limit($item->title, 60) }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Tags cloud --}}
            @if($tags->isNotEmpty())
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Tags</h3>
                    <div class="sidebar-tag-cloud">
                        @foreach($tags as $tag)
                            <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}"
                               class="sidebar-tag {{ request('tag') === $tag->slug ? 'active' : '' }}">
                                {{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Donate CTA --}}
            <div class="sidebar-widget sidebar-donate-cta">
                <p class="sidebar-donate-label">Support our work</p>
                <h4 class="sidebar-donate-heading">Help women in Uganda's fishing communities</h4>
                <a href="{{ route('donate') }}" class="btn-primary" style="width:100%;justify-content:center;margin-top:1rem">
                    Donate Now
                </a>
            </div>

        </aside>

    </div>{{-- /.show-layout --}}

    {{-- ── Related posts (full-width below layout) ────────── --}}
    @if($related->count())
        <section class="related-posts reveal">
            <div class="section-header" style="margin-bottom:2.5rem">
                <span class="section-label">Keep Reading</span>
                <h2 class="section-title">Related Articles</h2>
            </div>
            <div class="blog-grid">
                @foreach($related as $item)
                    <x-blog-card :post="$item" />
                @endforeach
            </div>
        </section>
    @endif

    <script>
        (function () {
            const obs = new IntersectionObserver(
                entries => entries.forEach(e => {
                    if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); }
                }),
                { threshold: 0.08 }
            );
            document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
        })();
    </script>

</x-layouts.app>
