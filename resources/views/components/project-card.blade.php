@props(['project'])

<a href="{{ route('projects.show', $project->content->slug) }}" class="project-card reveal group">
    <div class="project-card-img-wrap">
        <img class="project-card-bg"
             src="{{ $project->content->featured_image }}"
             alt="{{ $project->content->title }}">
        <div class="project-card-overlay"></div>
    </div>

    <div class="project-card-content">
        <h3>{{ $project->content->title }}</h3>

        <p>{{ Str::limit($project->content->excerpt, 90) }}</p>

        <div class="project-meta">
            @if($project->location)
                <span>📍 {{ $project->location }}</span>
            @endif
            @if($project->beneficiaries_count)
                <span>👥 {{ number_format($project->beneficiaries_count) }}</span>
            @endif
        </div>

        <div class="project-cta-link">
            View project
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </div>
    </div>
</a>
