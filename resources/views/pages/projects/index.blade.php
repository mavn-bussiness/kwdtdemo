<x-layouts.app title="Ongoing Projects" metaDescription="Current initiatives by KWDT">

    <div class="page-hero page-hero--short">
        <div class="page-hero-content">
            <span class="section-label">Projects</span>
            <h1 class="page-title">Ongoing Projects</h1>
        </div>
    </div>

    <section class="section">
        {{-- Optional: Status filter tabs --}}
        @if(request()->has('status') || $projects->count() > 0)
            <div class="filter-tabs">
                <a href="{{ route('projects.index') }}"
                   class="filter-tab {{ !request('status') ? 'active' : '' }}">
                    All
                </a>
                <a href="{{ route('projects.index', ['status' => 'ongoing']) }}"
                   class="filter-tab {{ request('status') == 'ongoing' ? 'active' : '' }}">
                    Ongoing
                </a>
                <a href="{{ route('projects.index', ['status' => 'completed']) }}"
                   class="filter-tab {{ request('status') == 'completed' ? 'active' : '' }}">
                    Completed
                </a>
                <a href="{{ route('projects.index', ['status' => 'upcoming']) }}"
                   class="filter-tab {{ request('status') == 'upcoming' ? 'active' : '' }}">
                    Upcoming
                </a>
            </div>
        @endif

        <div class="projects-grid">
            @forelse($projects as $project)
                <x-project-card :project="$project" />
            @empty
                <div class="empty-state">
                    <p>No projects available at the moment.</p>
                </div>
            @endforelse
        </div>

        @if($projects->hasPages())
            <div class="pagination-wrap">
                {{ $projects->links() }}
            </div>
        @endif
    </section>

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
