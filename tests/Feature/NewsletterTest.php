<?php

use App\Livewire\Newslettersignup;
use App\Models\NewsletterSubscriber;
use Livewire\Livewire;

it('subscribes a new email successfully', function () {
    Livewire::test(Newslettersignup::class)
        ->set('email', 'newuser@example.com')
        ->set('consent', true)
        ->call('subscribe')
        ->assertSet('state', 'success');

    expect(NewsletterSubscriber::where('email', 'newuser@example.com')->exists())->toBeTrue();
});

it('shows already state for an existing active subscriber', function () {
    NewsletterSubscriber::factory()->create([
        'email' => 'existing@example.com',
        'is_active' => true,
    ]);

    Livewire::test(Newslettersignup::class)
        ->set('email', 'existing@example.com')
        ->set('consent', true)
        ->call('subscribe')
        ->assertSet('state', 'already');
});

it('resubscribes an inactive subscriber', function () {
    $subscriber = NewsletterSubscriber::factory()->create([
        'email' => 'inactive@example.com',
        'is_active' => false,
    ]);

    Livewire::test(Newslettersignup::class)
        ->set('email', 'inactive@example.com')
        ->set('consent', true)
        ->call('subscribe')
        ->assertSet('state', 'success');

    expect($subscriber->fresh()->is_active)->toBeTrue();
});

it('requires a valid email', function () {
    Livewire::test(Newslettersignup::class)
        ->set('email', 'not-an-email')
        ->set('consent', true)
        ->call('subscribe')
        ->assertHasErrors(['email' => 'email']);
});

it('requires consent to subscribe', function () {
    Livewire::test(Newslettersignup::class)
        ->set('email', 'user@example.com')
        ->set('consent', false)
        ->call('subscribe')
        ->assertHasErrors(['consent']);
});
