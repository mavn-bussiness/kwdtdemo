@props(['project'])

@if($project->content)
<a href="{{ route('projects.show', $project->content->slug) }}" class="project-card reveal group">
    <div class="project-card-img">
        @if($project->content->featured_image)
            <img src="{{ $project->content->featured_image }}"
                 alt="{{ $project->content->title }}"
                 loading="lazy">
        @endif
        <div class="project-card-overlay"></div>
    </div>

    <div class="project-card-content">
        <span class="project-category">{{ $project->statusLabel() }}</span>
        <h3 class="project-title">{{ $project->content->title }}</h3>

        <div class="project-meta">
            @if($project->location)
                <span class="project-location">
                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    {{ $project->location }}
                </span>
            @endif
            @if($project->beneficiaries_count)
                <span class="project-date">{{ number_format($project->beneficiaries_count) }} beneficiaries</span>
            @endif
        </div>
    </div>
</a>
@endif
