<x-layouts.app title="Blog & News" metaDescription="Latest news, stories and updates from KWDT and Uganda's fisher communities.">

    {{-- ── Page Hero ─────────────────────────────────────────── --}}
    <div class="page-hero page-hero--short">
        <div class="page-hero-content">
            <span class="section-label" style="color:var(--orange-light)">Blog & News</span>
            <h1 class="page-title">Stories from the Field</h1>
            <p class="page-intro">
                News, insights and stories from KWDT and Uganda's fisher communities.
            </p>
        </div>
    </div>

    <section class="section">

        {{-- ── Category filter tabs ─────────────────────────── --}}
        <div class="filter-tabs reveal">
            <a href="{{ route('blog.index') }}"
               class="filter-tab {{ !request('category') ? 'active' : '' }}">
                All
            </a>
            @foreach($categories as $category)
                <a href="{{ route('blog.index', ['category' => $category->slug]) }}"
                   class="filter-tab {{ request('category') === $category->slug ? 'active' : '' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>

        {{-- ── Featured post ────────────────────────────────── --}}
        @if($featured)
            <a href="{{ route('blog.show', $featured->slug) }}" class="blog-featured reveal">
                <div class="blog-featured-img">
                    <img src="{{ $featured->featured_image }}"
                         alt="{{ $featured->title }}"
                         loading="eager">
                </div>
                <div class="blog-featured-content">
                    <span class="blog-category">
                        {{ $featured->categories->first()?->name ?? 'News' }}
                    </span>
                    <h2>{{ $featured->title }}</h2>
                    <p>{{ $featured->excerpt }}</p>
                    <span class="blog-date">
                        {{ $featured->published_at->format('M d, Y') }}
                    </span>
                </div>
            </a>
        @endif

        {{-- ── Posts grid ───────────────────────────────────── --}}
        <div class="blog-grid blog-grid--full">
            @forelse($posts as $post)
                <a href="{{ route('blog.show', $post->slug) }}" class="blog-card reveal">
                    <div class="blog-img">
                        @if($post->featured_image)
                            <img src="{{ $post->featured_image }}"
                                 alt="{{ $post->title }}"
                                 loading="lazy">
                        @else
                            <div class="blog-img-placeholder"></div>
                        @endif
                    </div>
                    <span class="blog-category">
                        {{ $post->categories->first()?->name ?? 'News' }}
                    </span>
                    <h3>{{ $post->title }}</h3>
                    <p>{{ $post->excerpt }}</p>
                    <span class="blog-date">
                        {{ $post->published_at->format('M d, Y') }}
                    </span>
                </a>
            @empty
                <div class="empty-state">
                    <p>No articles published yet. Check back soon.</p>
                </div>
            @endforelse
        </div>

        {{-- ── Pagination ────────────────────────────────────── --}}
        @if($posts->hasPages())
            <div class="pagination-wrap">
                {{ $posts->links() }}
            </div>
        @endif

    </section>

    {{-- ── Scroll reveal — same IIFE pattern as about page ─── --}}
    <script>
        (function () {
            const obs = new IntersectionObserver(
                entries => entries.forEach(e => {
                    if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); }
                }),
                { threshold: 0.1 }
            );
            document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
        })();
    </script>

</x-layouts.app>
