<?php

use App\Livewire\DonationForm;
use App\Models\Donation;
use Livewire\Livewire;

it('starts on the amount step', function () {
    Livewire::test(DonationForm::class)
        ->assertSet('step', 'amount');
});

it('proceeds to details step with a preset amount', function () {
    Livewire::test(DonationForm::class)
        ->set('selectedAmount', '25')
        ->call('proceedToDetails')
        ->assertSet('step', 'details')
        ->assertSet('errorMessage', '');
});

it('proceeds to details step with a valid custom amount', function () {
    Livewire::test(DonationForm::class)
        ->set('selectedAmount', 'custom')
        ->set('customAmount', '75')
        ->call('proceedToDetails')
        ->assertSet('step', 'details');
});

it('shows error when custom amount is empty', function () {
    Livewire::test(DonationForm::class)
        ->set('selectedAmount', 'custom')
        ->set('customAmount', '')
        ->call('proceedToDetails')
        ->assertSet('step', 'amount')
        ->assertSet('errorMessage', 'Please enter a donation amount.');
});

it('shows error when amount is zero or negative', function () {
    Livewire::test(DonationForm::class)
        ->set('selectedAmount', 'custom')
        ->set('customAmount', '-5')
        ->call('proceedToDetails')
        ->assertSet('step', 'amount')
        ->assertSet('errorMessage', 'Please enter a valid donation amount.');
});

it('validates donor name and email when not anonymous', function () {
    Livewire::test(DonationForm::class)
        ->set('step', 'details')
        ->set('selectedAmount', '50')
        ->set('isAnonymous', false)
        ->set('donorName', '')
        ->set('donorEmail', '')
        ->call('submitDonation')
        ->assertHasErrors(['donorName', 'donorEmail']);
});

it('validates donor email format', function () {
    Livewire::test(DonationForm::class)
        ->set('step', 'details')
        ->set('selectedAmount', '50')
        ->set('isAnonymous', false)
        ->set('donorName', 'Jane Doe')
        ->set('donorEmail', 'not-an-email')
        ->call('submitDonation')
        ->assertHasErrors(['donorEmail' => 'email']);
});

it('resets form to initial state', function () {
    Livewire::test(DonationForm::class)
        ->set('donorName', 'Jane Doe')
        ->set('donorEmail', 'jane@example.com')
        ->set('step', 'details')
        ->call('resetForm')
        ->assertSet('step', 'amount')
        ->assertSet('donorName', '')
        ->assertSet('donorEmail', '')
        ->assertSet('errorMessage', '');
});

it('selects a preset amount and clears custom amount', function () {
    Livewire::test(DonationForm::class)
        ->set('customAmount', '999')
        ->call('selectAmount', '100')
        ->assertSet('selectedAmount', '100')
        ->assertSet('customAmount', '');
});

it('donation model displays anonymous name correctly', function () {
    $donation = Donation::factory()->create(['is_anonymous' => true, 'donor_name' => 'Jane']);
    expect($donation->displayName())->toBe('Anonymous');
});

it('donation model displays donor name when not anonymous', function () {
    $donation = Donation::factory()->create(['is_anonymous' => false, 'donor_name' => 'Jane Doe']);
    expect($donation->displayName())->toBe('Jane Doe');
});
