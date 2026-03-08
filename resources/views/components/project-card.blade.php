@props(['project'])

<a href="{{ route('projects.show', $project->content->slug) }}" class="project-card reveal group">
    <img class="project-card-bg transition-transform duration-500 group-hover:scale-105"
         src="{{ $project->content->featured_image }}"
         alt="{{ $project->content->title }}">

    <div class="project-card-overlay"></div>

    <div class="project-card-content">
        <span class="project-status project-status--{{ $project->status }}">
            ● {{ $project->statusLabel() }}
        </span>

        <h3>{{ $project->content->title }}</h3>

        <p>{{ Str::limit($project->content->excerpt, 110) }}</p>

        <div class="project-meta">
            @if($project->location)
                <span>📍 {{ $project->location }}</span>
            @endif
            @if($project->beneficiaries_count)
                <span>👥 {{ number_format($project->beneficiaries_count) }}</span>
            @endif
        </div>

        {{-- Read more nudge --}}
        <div class="flex items-center gap-1 mt-3 text-xs font-semibold
                    opacity-0 group-hover:opacity-100 transition-all duration-300
                    group-hover:translate-y-0 translate-y-1"
             style="color:rgba(255,255,255,.75)">
            View project
            <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:translate-x-0.5"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </div>
    </div>
</a>