<x-layouts.app :title="$project->content->title" :metaDescription="$project->content->excerpt">

    <div class="inner-page-header">
        <div class="inner-page-header-inner">
            <a href="{{ route('projects.index') }}" class="inner-back-link">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                All Projects
            </a>
            <h1 class="inner-page-title">{{ $project->content->title }}</h1>
        </div>
    </div>

    {{-- Two-column layout --}}
    <div class="show-layout">
        {{-- Main column --}}
        <div class="show-main">
            {{-- Featured image --}}
            @if($project->content->featuredImageUrl())
                <div class="show-featured-img">
                    <img src="{{ $project->content->featuredImageUrl() }}"
                         alt="{{ $project->content->title }}">
                </div>
            @endif

            {{-- Project meta --}}
            <div class="show-meta">
                <span class="show-meta-item project-status--{{ $project->status }}">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <circle cx="12" cy="12" r="10"/>
                    </svg>
                    {{ $project->statusLabel() }}
                </span>

                @if($project->location)
                    <span class="show-meta-sep" aria-hidden="true">|</span>
                    <span class="show-meta-item">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        {{ $project->location }}
                    </span>
                @endif

                @if($project->start_date)
                    <span class="show-meta-sep" aria-hidden="true">|</span>
                    <span class="show-meta-item">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        Started {{ $project->start_date->format('M Y') }}
                    </span>
                @endif

                @if($project->beneficiaries_count)
                    <span class="show-meta-sep" aria-hidden="true">|</span>
                    <span class="show-meta-item">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                            <path d="M16 3.13a4 4 0 010 7.75"/>
                        </svg>
                        {{ number_format($project->beneficiaries_count) }} beneficiaries
                    </span>
                @endif
            </div>

            {{-- Project description --}}
            @if($project->content->body)
                <div class="show-body prose">
                    {!! $project->content->body !!}
                </div>
            @endif

            {{-- Project gallery --}}
            @if($project->content->media->count())
                <div class="show-gallery">
                    @foreach($project->content->media as $media)
                        <div class="gallery-item">
                            <img src="{{ Storage::url($media->file_path) }}"
                                 alt="{{ $media->alt_text ?? $project->content->title }}"
                                 loading="lazy">
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Share buttons --}}
            <div class="show-tags-row">
                <span class="show-share-label">Share:</span>
                <div class="show-share-icons">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                       target="_blank"
                       class="show-share-icon"
                       aria-label="Share on Facebook">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/>
                        </svg>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($project->content->title) }}"
                       target="_blank"
                       class="show-share-icon"
                       aria-label="Share on Twitter">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                       target="_blank"
                       class="show-share-icon"
                       aria-label="Share on LinkedIn">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6z"/>
                            <rect x="2" y="9" width="4" height="12"/>
                            <circle cx="4" cy="4" r="2"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="news-sidebar">
            {{-- Donate widget --}}
            <div class="sidebar-widget sidebar-donate-cta">
                <div class="sidebar-donate-label">Support our work</div>
                <h3 class="sidebar-donate-heading">Make an impact today</h3>
                <a href="{{ route('donate') }}" class="btn-primary" style="margin-top:1rem; width:100%; justify-content:center;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
                    </svg>
                    Donate Now
                </a>
            </div>

            {{-- Related projects (you can implement this later) --}}
            {{-- <div class="sidebar-widget">
                <h4 class="sidebar-widget-title">Related Projects</h4>
                <div class="sidebar-recent-list">
                    ...
                </div>
            </div> --}}
        </div>
    </div>

    {{-- Call to action --}}
    <div class="about-bottom-cta">
        <div class="about-bottom-cta-inner">
            <h2>Support Women in Fisher Communities</h2>
            <p>Your contribution helps us continue this important work across Mukono, Kalangala, and Buvuma districts.</p>
            <div class="about-cta-btns">
                <a href="{{ route('donate') }}" class="btn-primary">Donate Now</a>
                <a href="{{ route('contact') }}" class="btn-outline">Contact Us</a>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const obs = new IntersectionObserver(
                entries => entries.forEach(e => {
                    if (e.isIntersecting) {
                        e.target.classList.add('visible');
                        obs.unobserve(e.target);
                    }
                }),
                { threshold: 0.1 }
            );
            document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
        })();
    </script>

</x-layouts.app>
