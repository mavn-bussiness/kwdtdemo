<?php

if (config('database.default') === 'null') {
    // database driver unavailable, skip these view sanity checks
    return;
}

it('renders the blog index view without hitting the database', function () {
    // render view with empty collections and verify static content
    $view = view('pages.blog.index', [
        'categories' => collect(),
        'posts' => collect(),
        'featured' => null,
    ]);

    $view->assertSee('Blog & News');
    $view->assertSee('Stories from the Field');
});

it('can render the blog show template with a dummy post', function () {
    $dummy = (object) [
        'title' => 'Dummy',
        'excerpt' => 'excerpt',
        'featured_image' => null,
        'categories' => collect(),
        'author' => (object) ['name' => 'Author'],
        'published_at' => now(),
        'body' => '<p>body</p>',
        'media' => collect(),
    ];
    $related = collect();

    $view = view('pages.blog.show', ['post' => $dummy, 'related' => $related]);
    $view->assertSee('Dummy');
    $view->assertSee('Back to Blog');
});

it('renders the donate success and failure blades directly', function () {
    view('pages.donate-success')->assertSee('Thank you for your donation');
    view('pages.donate-failed')->assertSee('Something went wrong');
});

