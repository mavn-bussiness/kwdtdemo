<?php

use App\Models\Content;
use App\Models\User;

// ── Blog index ────────────────────────────────────────────────────────────────

it('renders the blog index page', function () {
    $this->get(route('blog.index'))->assertOk();
});

it('shows published blog posts on the index', function () {
    $author = User::factory()->create(['role' => 'editor']);

    Content::factory()->create([
        'type'         => 'blog',
        'status'       => 'published',
        'title'        => 'A Published Story',
        'published_at' => now(),
        'author_id'    => $author->id,
    ]);

    $this->get(route('blog.index'))->assertSee('A Published Story');
});

it('does not show draft blog posts on the index', function () {
    $author = User::factory()->create(['role' => 'editor']);

    Content::factory()->create([
        'type'      => 'blog',
        'status'    => 'draft',
        'title'     => 'A Draft Story',
        'author_id' => $author->id,
    ]);

    $this->get(route('blog.index'))->assertDontSee('A Draft Story');
});

it('does not show news type posts — they are now blog type', function () {
    // After the migration, 'news' no longer exists as a type
    $types = \Illuminate\Support\Facades\DB::select("SHOW COLUMNS FROM content LIKE 'type'");
    $typeColumn = $types[0] ?? null;

    if ($typeColumn) {
        expect($typeColumn->Type)->not->toContain("'news'");
    }
});

// ── Blog show ─────────────────────────────────────────────────────────────────

it('renders a published blog post show page', function () {
    $author = User::factory()->create(['role' => 'editor']);

    $post = Content::factory()->create([
        'type'         => 'blog',
        'status'       => 'published',
        'title'        => 'My Test Post',
        'slug'         => 'my-test-post',
        'body'         => '<p>Hello world content</p>',
        'published_at' => now(),
        'author_id'    => $author->id,
    ]);

    $this->get(route('blog.show', $post->slug))
        ->assertOk()
        ->assertSee('My Test Post')
        ->assertSee('Hello world content', false);
});

it('returns 404 for a non-existent blog post', function () {
    $this->get(route('blog.show', 'does-not-exist'))->assertNotFound();
});

it('returns 404 for a draft blog post', function () {
    $author = User::factory()->create(['role' => 'editor']);

    $post = Content::factory()->create([
        'type'      => 'blog',
        'status'    => 'draft',
        'slug'      => 'draft-post',
        'author_id' => $author->id,
    ]);

    $this->get(route('blog.show', $post->slug))->assertNotFound();
});
