<x-layouts.app title="Careers" metaDescription="Join the Katosi Women Development Trust team — current job vacancies and opportunities in Uganda.">

    <style>
        .careers-section { padding: var(--space-xl) var(--space-md); max-width: 1280px; margin: 0 auto; }

        .careers-empty {
            text-align: center; padding: 5rem 1rem; color: var(--earth-muted);
            display: flex; flex-direction: column; align-items: center; gap: 1rem;
        }

        .job-list { display: flex; flex-direction: column; gap: 1.25rem; }

        .job-card {
            background: var(--white);
            border: 1px solid var(--cream-dark);
            border-radius: var(--r-lg);
            border-left: 4px solid var(--orange);
            padding: 2rem 2.25rem;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 1rem 2rem;
            align-items: start;
            transition: box-shadow .3s var(--ease), transform .3s;
        }
        .job-card:hover {
            box-shadow: 0 12px 40px rgba(43,26,14,.1);
            transform: translateY(-3px);
        }

        .job-card-main {}

        .job-meta {
            display: flex; align-items: center; gap: .75rem;
            flex-wrap: wrap; margin-bottom: .6rem;
        }
        .job-advert-num {
            font-family: var(--font-mono); font-size: .65rem; font-weight: 500;
            letter-spacing: .12em; text-transform: uppercase;
            color: var(--orange); background: var(--orange-pale);
            padding: .25rem .7rem; border-radius: var(--r-pill);
        }
        .job-status {
            font-family: var(--font-mono); font-size: .65rem; font-weight: 600;
            letter-spacing: .1em; text-transform: uppercase;
            color: var(--forest-mid); background: rgba(31,74,46,.08);
            padding: .25rem .7rem; border-radius: var(--r-pill);
        }

        .job-title {
            font-family: var(--font-display); font-size: 1.25rem; font-weight: 700;
            color: var(--earth); line-height: 1.3; margin-bottom: .65rem;
            transition: color .2s;
        }
        .job-card:hover .job-title { color: var(--orange); }

        .job-description {
            font-size: .9rem; color: var(--earth-muted);
            line-height: 1.7; max-width: 72ch;
        }

        .job-dates {
            display: flex; flex-direction: column; gap: .35rem;
            margin-top: 1rem;
        }
        .job-date {
            display: flex; align-items: center; gap: .5rem;
            font-size: .78rem; color: var(--earth-light);
            font-family: var(--font-mono); letter-spacing: .04em;
        }
        .job-date-dot {
            width: 6px; height: 6px; border-radius: 50%;
            background: var(--cream-dark); flex-shrink: 0;
        }
        .job-date--deadline .job-date-dot { background: var(--orange); }

        .job-card-actions {
            display: flex; flex-direction: column; gap: .65rem;
            align-items: flex-end; flex-shrink: 0;
        }

        .job-apply-btn {
            display: inline-flex; align-items: center; gap: .45rem;
            background: var(--orange); color: var(--white);
            font-weight: 600; font-size: .875rem;
            padding: .7rem 1.5rem; border-radius: var(--r-pill);
            white-space: nowrap;
            transition: background .2s, transform .2s, box-shadow .2s;
        }
        .job-apply-btn:hover {
            background: var(--orange-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(224,120,24,.4);
        }

        .job-pdf-link {
            display: inline-flex; align-items: center; gap: .4rem;
            font-size: .8rem; font-weight: 600; color: var(--earth-muted);
            padding: .55rem 1.1rem; border-radius: var(--r-pill);
            border: 1.5px solid var(--cream-dark);
            transition: border-color .2s, color .2s;
            white-space: nowrap;
        }
        .job-pdf-link:hover { border-color: var(--orange); color: var(--orange); }

        /* Info aside */
        .careers-aside {
            background: var(--earth);
            border-radius: var(--r-lg);
            padding: 2.5rem;
            margin-top: 4rem;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 2rem;
            align-items: start;
        }
        .careers-aside-block {}
        .careers-aside-label {
            font-family: var(--font-mono); font-size: .65rem;
            letter-spacing: .16em; text-transform: uppercase;
            color: var(--orange-light); margin-bottom: .5rem;
        }
        .careers-aside-text {
            font-size: .9rem; color: rgba(253,246,237,.7); line-height: 1.65;
        }
        .careers-aside-text a { color: var(--orange-light); }
        .careers-aside-text a:hover { text-decoration: underline; }

        @media (max-width: 820px) {
            .job-card { grid-template-columns: 1fr; }
            .job-card-actions { flex-direction: row; align-items: center; }
            .careers-aside { grid-template-columns: 1fr; gap: 1.5rem; }
        }
        @media (max-width: 500px) {
            .job-card { padding: 1.5rem; }
            .job-card-actions { flex-wrap: wrap; }
        }
    </style>

    {{-- ── Hero ────────────────────────────────────────────────── --}}
    <div class="news-hero">
        <div class="news-hero-bg">
            <img src="https://images.squarespace-cdn.com/content/v1/66daa23ce2a9864d9d00cc45/82eada9f-8188-4ebd-bab8-3fdcf85ca5f8/ARCHE_UGANDA_194.jpg"
                 alt="KWDT team at work"
                 loading="eager">
        </div>
        <div class="news-hero-overlay"></div>
        <div class="news-hero-content">
            <span class="news-hero-label">Work With Us</span>
            <h1 class="news-hero-title">Careers at KWDT</h1>
            <p class="news-hero-sub">Join a team dedicated to transforming lives in Uganda's fishing communities.</p>
        </div>
    </div>

    {{-- ── Job listings ─────────────────────────────────────────── --}}
    <section class="careers-section">

        @if($jobs->isEmpty())
            <div class="careers-empty reveal">
                <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0"/>
                </svg>
                <p style="font-size:1.05rem; font-weight:600; color:var(--earth)">No open positions right now</p>
                <p style="max-width:40ch">We're not actively hiring at the moment, but check back soon or send us a speculative application.</p>
                <a href="{{ route('contact') }}" class="btn-outline" style="margin-top:.5rem">Send Speculative CV</a>
            </div>
        @else
            <div class="job-list">
                @foreach($jobs as $job)
                    <div class="job-card reveal">

                        <div class="job-card-main">
                            <div class="job-meta">
                                @if($job->advert_number)
                                    <span class="job-advert-num">{{ $job->advert_number }}</span>
                                @endif
                                <span class="job-status">Open</span>
                            </div>

                            <h2 class="job-title">{{ $job->title }}</h2>

                            @if($job->description)
                                <p class="job-description">{{ Str::limit($job->description, 220) }}</p>
                            @endif

                            <div class="job-dates">
                                @if($job->posted_at)
                                    <span class="job-date">
                                        <span class="job-date-dot"></span>
                                        Posted {{ $job->posted_at->format('d M Y') }}
                                    </span>
                                @endif
                                @if($job->closed_at)
                                    <span class="job-date job-date--deadline">
                                        <span class="job-date-dot"></span>
                                        Deadline: {{ $job->closed_at->format('d M Y') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="job-card-actions">
                            <a href="mailto:info@katosi.org?subject=Application – {{ urlencode($job->title) }}"
                               class="job-apply-btn">
                                Apply Now
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                            @if($job->pdf_url)
                                <a href="{{ $job->pdf_url }}" target="_blank" rel="noopener" class="job-pdf-link">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                    </svg>
                                    Job Advert (PDF)
                                </a>
                            @endif
                        </div>

                    </div>
                @endforeach
            </div>
        @endif

        {{-- ── Info aside ──────────────────────────────────────── --}}
        <div class="careers-aside reveal">
            <div class="careers-aside-block">
                <p class="careers-aside-label">How to Apply</p>
                <p class="careers-aside-text">
                    Send your CV and a cover letter to
                    <a href="mailto:info@katosi.org">info@katosi.org</a>
                    quoting the advert number. Only shortlisted candidates will be contacted.
                </p>
            </div>
            <div class="careers-aside-block">
                <p class="careers-aside-label">Equal Opportunity</p>
                <p class="careers-aside-text">
                    KWDT is an equal-opportunity employer. Women, people with disabilities,
                    and candidates from marginalised communities are especially encouraged to apply.
                </p>
            </div>
            <div class="careers-aside-block">
                <p class="careers-aside-label">Speculative Applications</p>
                <p class="careers-aside-text">
                    Don't see a suitable role? We welcome speculative applications.
                    <a href="{{ route('contact') }}">Contact us</a> and we'll keep your CV on file.
                </p>
            </div>
        </div>

    </section>
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
