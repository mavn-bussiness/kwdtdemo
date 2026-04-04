<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;

class BlogController extends Controller
{
    public function index()
    {
        // ── Featured post (latest, used for hero bg) ─────────────────────────
        $featured = Content::published()->ofType('blog')
            ->latestPublished()
            ->with('categories')
            ->first();

        // ── Sidebar: 5 most-recent posts (independent of filters) ────────────
        $recent = Content::published()->ofType('blog')
            ->latestPublished()
            ->with('categories')
            ->take(5)
            ->get();

        // ── Categories with post counts ───────────────────────────────────────
        $categories = Category::whereHas(
            'content',
            fn ($q) => $q->published()->ofType('blog')
        )
            ->withCount([
                'content as content_count' => fn ($q) => $q->published()->ofType('blog'),
            ])
            ->orderByDesc('content_count')
            ->get();

        // ── Main paginated post list ──────────────────────────────────────────
        $query = Content::published()->ofType('blog')
            ->latestPublished()
            ->with('categories');

        // Category filter
        if ($category = request('category')) {
            $query->whereHas('categories', fn ($q) => $q->where('slug', $category));
        }

        // Tag filter
        if ($tag = request('tag')) {
            $query->whereHas('categories', fn ($q) => $q->where('slug', $tag));
        }

        // Search
        if ($search = request('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('body', 'like', "%{$search}%");
            });
        }

        $posts = $query->paginate(6)->withQueryString();

        return view('pages.blog.index', compact(
            'featured',
            'posts',
            'categories',
            'recent',
        ));
    }

    public function show(string $slug)
    {
        $post = Content::published()->ofType('blog')
            ->where('slug', $slug)
            ->with(['categories', 'author', 'media'])
            ->firstOrFail();

        $related = Content::published()->ofType('blog')
            ->where('id', '!=', $post->id)
            ->whereHas(
                'categories',
                fn ($q) => $q->whereIn('categories.id', $post->categories->pluck('id'))
            )
            ->with('categories')
            ->latestPublished()
            ->take(3)
            ->get();

        // Sidebar data
        $recent = Content::published()->ofType('blog')
            ->where('id', '!=', $post->id)
            ->latestPublished()
            ->with('categories')
            ->take(5)
            ->get();

        $categories = Category::whereHas(
            'content',
            fn ($q) => $q->published()->ofType('blog')
        )->get();

        return view('pages.blog.show', compact(
            'post',
            'related',
            'recent',
            'categories',
        ));
    }
}
