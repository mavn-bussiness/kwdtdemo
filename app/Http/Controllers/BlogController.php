<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;

class BlogController extends Controller
{
    public function index()
    {
        $categories = Category::whereHas(
            'content',
            fn($q) => $q->published()->ofType('blog')
        )->get();

        $query = Content::published()->ofType('blog')->latestPublished()->with('categories');

        if ($category = request('category')) {
            $query->whereHas('categories', fn($q) => $q->where('slug', $category));
        }

        $featured = Content::published()->ofType('blog')
            ->latestPublished()->first();

        $posts = $query->paginate(9);

        return view('pages.blog.index', compact('posts', 'categories', 'featured'));
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
                fn($q) => $q->whereIn('categories.id', $post->categories->pluck('id'))
            )
            ->with('categories')
            ->latestPublished()
            ->take(3)
            ->get();

        return view('pages.blog.show', compact('post', 'related'));
    }
}
