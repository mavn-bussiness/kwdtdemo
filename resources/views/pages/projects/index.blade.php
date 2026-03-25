<x-layouts.app title="Our Work" metaDescription="Our initiatives and impact in the community">

    <div class="page-hero page-hero--short">
        <div class="page-hero-content">
            <span class="section-label">Impact</span>
            <h1 class="page-title">Our Work</h1>
        </div>
    </div>

    <section class="section">
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
