<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Event;
use App\Models\Project;
use App\Services\HomepageCache;

class HomeController extends Controller
{
    public function index()
    {
        $data = HomepageCache::get();

        return view('pages.home', [
            'featuredProjects' => $data['projects'],
            'latestBlogs'      => $data['blogs'],
            'partners'         => $data['partners'],
            'testimonials'     => $data['testimonials'],
            'heroSlides'       => $this->resolveHeroSlides(),
        ]);
    }

    /**
     * Build the ordered list of hero slides.
     *
     * Slot layout (up to 5 slides):
     *   0-2 — Three latest published news/blog posts   (type: news)
     *     3 — Next upcoming event                      (type: event)
     *     4 — Most recently updated ongoing project    (type: project)
     *
     * Empty slots are omitted — the slideshow works fine with 1–5 slides.
     */
    private function resolveHeroSlides(): array
    {
        $slides = [];

        // ── Slots 0-2 — three latest published blog / news articles ──────────
        try {
            $posts = Content::published()
                ->ofType('blog')
                ->latestPublished()
                ->take(3)
                ->get();

            foreach ($posts as $post) {
                $slides[] = [
                    'type'  => 'blog',
                    'title' => $post->title,
                    'url'   => route('blog.show', $post->slug),
                    'image' => $post->featured_image ?? null,
                    'meta'  => $post->published_at?->format('d M Y'),
                ];
            }
        } catch (\Exception $e) {
            //
        }

        // ── Slot 3 — next upcoming event ─────────────────────────────────────
        try {
            $event = Event::with('content')
                ->upcoming()
                ->orderBy('event_date')
                ->first();

            if ($event?->content) {
                $slides[] = [
                    'type'  => 'event',
                    'title' => $event->content->title,
                    'url'   => route('blog.show', $event->content->slug),
                    'image' => $event->content->featured_image ?? null,
                    'meta'  => $event->event_date->format('d M Y')
                        . ($event->venue ? ' · ' . $event->venue : ''),
                ];
            }
        } catch (\Exception $e) {
            //
        }

        // ── Slot 4 — most recently updated ongoing project ────────────────────
        try {
            $project = Project::with('content')
                ->latest('updated_at')
                ->first();

            if ($project?->content) {
                $slides[] = [
                    'type'  => 'project',
                    'title' => $project->content->title,
                    'url'   => route('projects.show', $project->content->slug),
                    'image' => $project->content->featured_image ?? null,
                    'meta'  => $project->location,
                ];
            }
        } catch (\Exception $e) {
            //
        }

        return $slides;
    }
}
