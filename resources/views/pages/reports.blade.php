<x-layouts.app
    title="Reports & Documents"
    metaDescription="Download annual reports and documents from KWDT.">

    <div class="news-hero news-hero--slim">
        <div class="news-hero-bg">
            <img src="/images/static/arche-uganda-194.jpg"
                 alt="KWDT documents and reports"
                 loading="eager">
        </div>
        <div class="news-hero-overlay"></div>
        <div class="news-hero-content">
            <span class="news-hero-label">Resources</span>
            <h1 class="news-hero-title">Reports &amp; Documents</h1>
            <p class="news-hero-sub">Transparency and accountability — download our annual reports and publications.</p>
        </div>
    </div>

    <section class="section">
        @forelse($reports as $year => $group)

            <h2 class="font-display font-semibold mb-4 flex items-center gap-3"
                style="font-family:var(--font-display); font-size:1.4rem; color:var(--ink)">
                {{ $year }}
                <span class="text-xs font-mono font-normal px-2.5 py-1 rounded-full"
                      style="background:var(--sand); color:var(--ink-light); letter-spacing:.08em">
                    {{ $group->count() }} {{ Str::plural('file', $group->count()) }}
                </span>
            </h2>

            <ul class="report-list">
                @foreach($group as $report)
                    <li>
                        <a href="{{ Storage::url($report->file_path) }}"
                           target="_blank"
                           rel="noopener"
                           class="group transition-all hover:-translate-y-0.5">
                            <span class="flex-1">{{ $report->content->title ?? $report->file_name }}</span>
                            @if($report->file_type)
                                <span class="shrink-0 text-xs font-mono font-semibold px-2 py-0.5 rounded"
                                      style="background:var(--sand-dark); color:var(--ink-light)">
                                    {{ strtoupper($report->file_type) }}
                                </span>
                            @endif
                            <svg class="w-4 h-4 shrink-0 opacity-40 transition-all duration-200
                                        group-hover:opacity-100 group-hover:translate-y-0.5"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                        </a>
                    </li>
                @endforeach
            </ul>

        @empty
            <div class="text-center py-16"
                 style="color:var(--ink-light)">
                <svg class="w-10 h-10 mx-auto mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <p>No reports available at the moment.</p>
            </div>
        @endforelse
    </section>

</x-layouts.app>
