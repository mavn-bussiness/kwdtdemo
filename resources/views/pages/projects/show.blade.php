<x-layouts.app :title="$project->content->title" :metaDescription="$project->content->excerpt">

    <div class="page-hero page-hero--short">
        <div class="page-hero-content">
            <span class="section-label">Project</span>
            <h1 class="page-title">{{ $project->content->title }}</h1>
        </div>
    </div>

    <section class="section project-detail">
        <div class="content-wrap">
            <p class="project-status">Status: {{ ucfirst($project->status) }}</p>
            <p>
                <strong>Location:</strong> {{ $project->location ?? 'N/A' }}<br>
                <strong>Start:</strong> {{ optional($project->start_date)->format('M d, Y') }}<br>
                <strong>End:</strong> {{ optional($project->end_date)->format('M d, Y') }}
            </p>
            @if($project->content->content)
                <div class="prose">
                    {!! $project->content->content !!}
                </div>
            @endif
        </div>

        @if($project->content->media->count())
            <div class="project-gallery">
                @foreach($project->content->media as $media)
                    <div class="gallery-item">
                        <img src="{{ Storage::url($media->file_path) }}" alt="{{ $media->alt_text }}">
                    </div>
                @endforeach
            </div>
        @endif
    </section>

    <div class="section-cta">
        <a href="{{ route('projects.index') }}" class="btn-outline">← Back to projects</a>
    </div>

</x-layouts.app>