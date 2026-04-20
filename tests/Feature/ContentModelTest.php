<?php

use App\Models\Award;
use App\Models\Content;
use App\Models\Partner;
use App\Models\TeamMember;
use App\Models\User;

// ── Content::featuredImageUrl() ───────────────────────────────────────────────

it('featuredImageUrl returns null when no image is set', function () {
    $author = User::factory()->create(['role' => 'editor']);
    $content = Content::factory()->create(['featured_image' => null, 'author_id' => $author->id]);

    expect($content->featuredImageUrl())->toBeNull();
});

it('featuredImageUrl returns external URLs unchanged', function () {
    $author = User::factory()->create(['role' => 'editor']);
    $content = Content::factory()->create([
        'featured_image' => 'https://example.com/image.jpg',
        'author_id'      => $author->id,
    ]);

    expect($content->featuredImageUrl())->toBe('https://example.com/image.jpg');
});

it('featuredImageUrl prepends storage path for local files', function () {
    $author = User::factory()->create(['role' => 'editor']);
    $content = Content::factory()->create([
        'featured_image' => 'content/images/photo.jpg',
        'author_id'      => $author->id,
    ]);

    expect($content->featuredImageUrl())->toContain('storage/content/images/photo.jpg');
});

// ── TeamMember::photoUrl() ────────────────────────────────────────────────────

it('teamMember photoUrl returns null when no photo is set', function () {
    $member = TeamMember::factory()->create(['photo_url' => null]);
    expect($member->photoUrl())->toBeNull();
});

it('teamMember photoUrl returns external URLs unchanged', function () {
    $member = TeamMember::factory()->create(['photo_url' => 'https://cdn.example.com/photo.jpg']);
    expect($member->photoUrl())->toBe('https://cdn.example.com/photo.jpg');
});

it('teamMember photoUrl prepends storage path for local files', function () {
    $member = TeamMember::factory()->create(['photo_url' => 'team/photos/jane.jpg']);
    expect($member->photoUrl())->toContain('storage/team/photos/jane.jpg');
});

// ── Award::imageUrl() ─────────────────────────────────────────────────────────

it('award imageUrl returns null when no image is set', function () {
    $award = Award::factory()->create(['image_url' => null]);
    expect($award->imageUrl())->toBeNull();
});

it('award imageUrl prepends storage path for local files', function () {
    $award = Award::factory()->create(['image_url' => 'awards/trophy.jpg']);
    expect($award->imageUrl())->toContain('storage/awards/trophy.jpg');
});

// ── Partner logo_url accessor ─────────────────────────────────────────────────

it('partner logo_url accessor prepends storage path for local files', function () {
    $partner = Partner::factory()->create(['logo_url' => 'partners/logos/giz.png']);
    expect($partner->logo_url)->toContain('storage/partners/logos/giz.png');
});

it('partner logo_url accessor returns external URLs unchanged', function () {
    $partner = Partner::factory()->create(['logo_url' => 'https://example.com/logo.png']);
    expect($partner->logo_url)->toBe('https://example.com/logo.png');
});

// ── Content type exclusions ───────────────────────────────────────────────────

it('content of type blog is visible in Posts and Pages', function () {
    $author = User::factory()->create(['role' => 'editor']);
    $content = Content::factory()->create(['type' => 'blog', 'author_id' => $author->id]);

    $query = Content::whereNotIn('type', ['event', 'project', 'report']);
    expect($query->where('id', $content->id)->exists())->toBeTrue();
});

it('content of type event is excluded from Posts and Pages query', function () {
    $author = User::factory()->create(['role' => 'editor']);
    $content = Content::factory()->create(['type' => 'event', 'author_id' => $author->id]);

    $query = Content::whereNotIn('type', ['event', 'project', 'report']);
    expect($query->where('id', $content->id)->exists())->toBeFalse();
});

it('content of type project is excluded from Posts and Pages query', function () {
    $author = User::factory()->create(['role' => 'editor']);
    $content = Content::factory()->create(['type' => 'project', 'author_id' => $author->id]);

    $query = Content::whereNotIn('type', ['event', 'project', 'report']);
    expect($query->where('id', $content->id)->exists())->toBeFalse();
});

it('content of type report is excluded from Posts and Pages query', function () {
    $author = User::factory()->create(['role' => 'editor']);
    $content = Content::factory()->create(['type' => 'report', 'author_id' => $author->id]);

    $query = Content::whereNotIn('type', ['event', 'project', 'report']);
    expect($query->where('id', $content->id)->exists())->toBeFalse();
});
