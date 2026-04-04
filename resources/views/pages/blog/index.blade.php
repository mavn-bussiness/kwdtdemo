<x-layouts.app title="Blog & News" metaDescription="Latest news, stories and updates from KWDT and Uganda's fisher communities.">

    {{-- ── Page Hero ─────────────────────────────────────────── --}}
    <div class="news-hero">
        <div class="news-hero-bg" aria-hidden="true">
            @if($featured?->featured_image)
                <img src="{{ $featured->featured_image }}" alt="{{ $featured->title }}" loading="eager">
            @else
                <img src="https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/82eada9f-8188-4ebd-bab8-3fdcf85ca5f8/ARCHE_UGANDA_194.jpg" alt="KWDT Community" loading="eager">
            @endif
        </div>
        <div class="news-hero-overlay" aria-hidden="true"></div>
        <div class="news-hero-content">
            <span class="news-hero-label">Blog &amp; News</span>
            <h1 class="news-hero-title">Stories from the Field</h1>
            <p class="news-hero-sub">
                News, insights and stories from KWDT and Uganda's fisher communities.
            </p>
        </div>
    </div>

    {{-- ── Sticky category filter bar ───────────────────────── --}}
    <div class="news-filter-bar">
        <div class="news-filter-inner">
            <a href="{{ route('blog.index') }}"
               class="news-filter-tab {{ !request('category') ? 'active' : '' }}">All</a>
            @foreach($categories as $category)
                <a href="{{ route('blog.index', ['category' => $category->slug]) }}"
                   class="news-filter-tab {{ request('category') === $category->slug ? 'active' : '' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>

    {{-- ── Main content + sidebar ────────────────────────────── --}}
    <div class="news-layout">

        {{-- ════ LEFT: main post list ════ --}}
        <main class="news-main">

            @forelse($posts as $post)
                <article class="news-post-item reveal">

                    {{-- Post image --}}
                    <a href="{{ route('blog.show', $post->slug) }}" class="news-post-img-wrap">
                        @if($post->featured_image)
                            <img src="{{ $post->featured_image }}"
                                 alt="{{ $post->title }}"
                                 loading="lazy">
                        @else
                            <div class="news-post-img-placeholder"></div>
                        @endif
                        <span class="news-post-category-badge">
                            {{ $post->categories->first()?->name ?? 'News' }}
                        </span>
                    </a>

                    {{-- Post meta + body --}}
                    <div class="news-post-body">
                        <div class="news-post-meta">
                            <span class="news-post-meta-item">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                {{ $post->published_at->format('F j, Y') }}
                            </span>
                            <span class="news-post-meta-sep" aria-hidden="true">·</span>
                            <span class="news-post-meta-item">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 14.66V20a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2h5.34"/><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"/></svg>
                                {{ $post->categories->first()?->name ?? 'News' }}
                            </span>
                        </div>

                        <a href="{{ route('blog.show', $post->slug) }}" class="news-post-title-link">
                            <h2 class="news-post-title">{{ $post->title }}</h2>
                        </a>

                        <p class="news-post-excerpt">{{ $post->excerpt }}</p>

                        <a href="{{ route('blog.show', $post->slug) }}" class="news-read-btn">
                            Read more
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 16 16 12 12 8"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                        </a>
                    </div>

                </article>
            @empty
                <div class="news-empty">
                    <p>No articles published yet. Check back soon.</p>
                </div>
            @endforelse

            {{-- Pagination --}}
            @if($posts->hasPages())
                <div class="pagination-wrap">
                    {{ $posts->links() }}
                </div>
            @endif

        </main>

        {{-- ════ RIGHT: sidebar ════ --}}
        <aside class="news-sidebar">

            {{-- Search --}}
            <div class="sidebar-widget">
                <form action="{{ route('blog.index') }}" method="GET" class="sidebar-search-form">
                    <input
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Search articles..."
                        class="sidebar-search-input"
                        aria-label="Search articles">
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

            {{-- Categories --}}
            @if($categories->isNotEmpty())
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Categories</h3>
                    <ul class="sidebar-cat-list">
                        <li>
                            <a href="{{ route('blog.index') }}"
                               class="sidebar-cat-link {{ !request('category') && !request('tag') ? 'active' : '' }}">
                                All Posts
                            </a>
                        </li>
                        @foreach($categories as $category)
                            <li>
                                <a href="{{ route('blog.index', ['category' => $category->slug]) }}"
                                   class="sidebar-cat-link {{ request('category') === $category->slug ? 'active' : '' }}">
                                    {{ $category->name }}
                                    @if($category->content_count)
                                        <span class="sidebar-cat-count">{{ $category->content_count }}</span>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Tags --}}
            @if($categories->isNotEmpty())
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Tags</h3>
                    <div class="sidebar-tag-cloud">
                        @foreach($categories as $tag)
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

    </div>{{-- /.news-layout --}}

    <script>
        (function () {
            const obs = new IntersectionObserver(
                entries => entries.forEach(e => {
                    if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); }
                }),
                { threshold: 0.06 }
            );
            document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
        })();
    </script>

</x-layouts.app>
