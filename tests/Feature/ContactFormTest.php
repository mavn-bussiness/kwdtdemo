<?php

use App\Livewire\ContactForm;
use App\Mail\ContactFormSubmitted;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;

it('sends contact form successfully', function () {
    Mail::fake();

    Livewire::test(ContactForm::class)
        ->set('name', 'Jane Doe')
        ->set('email', 'jane@example.com')
        ->set('subject', 'Inquiry about KWDT')
        ->set('message', 'I would like to learn more about your programs and how I can help.')
        ->call('send')
        ->assertSet('state', 'success');

    Mail::assertSent(ContactFormSubmitted::class);
});

it('requires all fields', function () {
    Livewire::test(ContactForm::class)
        ->call('send')
        ->assertHasErrors(['name', 'email', 'subject', 'message']);
});

it('requires a valid email address', function () {
    Livewire::test(ContactForm::class)
        ->set('name', 'Jane Doe')
        ->set('email', 'not-an-email')
        ->set('subject', 'Hello')
        ->set('message', 'This is a test message that is long enough.')
        ->call('send')
        ->assertHasErrors(['email' => 'email']);
});

it('requires message to be at least 20 characters', function () {
    Livewire::test(ContactForm::class)
        ->set('name', 'Jane Doe')
        ->set('email', 'jane@example.com')
        ->set('subject', 'Hello')
        ->set('message', 'Too short')
        ->call('send')
        ->assertHasErrors(['message' => 'min']);
});

it('resets fields after successful submission', function () {
    Mail::fake();

    Livewire::test(ContactForm::class)
        ->set('name', 'Jane Doe')
        ->set('email', 'jane@example.com')
        ->set('subject', 'Inquiry')
        ->set('message', 'I would like to learn more about your programs and how I can help.')
        ->call('send')
        ->assertSet('name', '')
        ->assertSet('email', '')
        ->assertSet('subject', '')
        ->assertSet('message', '');
});
