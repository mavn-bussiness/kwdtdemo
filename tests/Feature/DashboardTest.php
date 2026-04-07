<?php

use App\Models\User;
use Filament\Panel;

test('guests are redirected to the admin login page', function () {
    $this->get('/admin')->assertRedirect();
});

test('authenticated admins can access the admin panel', function () {
    $user = User::factory()->create(['role' => 'super_admin']);

    expect($user->canAccessPanel(app(Panel::class)))->toBeTrue();
});
