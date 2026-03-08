<x-layouts.app :title="$post->title" :metaDescription="$post->excerpt">

    {{-- ── Hero image ────────────────────────────────────────── --}}
    @if($post->featured_image)
        <div class="post-hero">
            <img src="{{ $post->featured_image }}"
                 alt="{{ $post->title }}"
                 loading="eager">
            <div class="post-hero-overlay"></div>
        </div>
    @endif

    <article class="post-article">

        {{-- ── Post header ──────────────────────────────────── --}}
        <div class="post-header reveal">
            <div class="post-meta-top">
                <a href="{{ route('blog.index') }}" class="back-link">← Back to Blog</a>
                <span class="blog-category">
                    {{ $post->categories->first()?->name ?? 'News' }}
                </span>
            </div>
            <h1 class="post-title">{{ $post->title }}</h1>
            <div class="post-meta">
                <span class="post-author">By {{ $post->author->name }}</span>
                <span class="post-date">{{ $post->published_at->format('F d, Y') }}</span>
            </div>
        </div>

        {{-- ── Post body ────────────────────────────────────── --}}
        <div class="post-body reveal">
            {!! $post->body !!}
        </div>

        {{-- ── Tags / categories ────────────────────────────── --}}
        @if($post->categories->count())
            <div class="post-tags reveal">
                @foreach($post->categories as $cat)
                    <a href="{{ route('blog.index', ['category' => $cat->slug]) }}"
                       class="tag">{{ $cat->name }}</a>
                @endforeach
            </div>
        @endif

        {{-- ── Image gallery ────────────────────────────────── --}}
        @php
            $galleryImages = $post->media->filter(fn($m) => str_starts_with($m->file_type, 'image/'));
        @endphp

        @if($galleryImages->count())
            <div class="post-gallery reveal">
                @foreach($galleryImages as $img)
                    <div class="gallery-item">
                        <img src="{{ Storage::url($img->file_path) }}"
                             alt="{{ $img->alt_text }}"
                             loading="lazy">
                    </div>
                @endforeach
            </div>
        @endif

    </article>

    {{-- ── Related posts ───────────────────────────────────── --}}
    @if($related->count())
        <section class="related-posts">
            <div class="section-header" style="margin-bottom:2.5rem">
                <span class="section-label reveal">Keep Reading</span>
                <h2 class="section-title reveal">Related Articles</h2>
            </div>
            <div class="blog-grid">
                @foreach($related as $item)
                    <div class="reveal">
                        <x-blog-card :post="$item" />
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{-- ── CTA ─────────────────────────────────────────────── --}}
    <div class="post-cta reveal">
        <h3>Support our work in Uganda's fishing communities</h3>
        <a href="{{ route('donate') }}" class="btn-primary">Donate Today</a>
    </div>

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
