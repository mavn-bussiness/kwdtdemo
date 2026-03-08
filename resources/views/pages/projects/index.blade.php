<x-layouts.app title="Ongoing Projects" metaDescription="Current initiatives by KWDT">

    <div class="page-hero page-hero--short">
        <div class="page-hero-content">
            <span class="section-label">Projects</span>
            <h1 class="page-title">Ongoing Projects</h1>
        </div>
    </div>

    <section class="section">
        <div class="projects-grid">
            @forelse($projects as $project)
                <a href="{{ route('projects.show', $project->content->slug) }}" class="project-card reveal">
                    <h3>{{ $project->content->title }}</h3>
                    <p>{{ $project->content->excerpt }}</p>
                    <span class="project-status">● {{ ucfirst($project->status) }}</span>
                </a>
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
                    if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); }
                }),
                { threshold: 0.1 }
            );
            document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
        })();
    </script>

</x-layouts.app>
