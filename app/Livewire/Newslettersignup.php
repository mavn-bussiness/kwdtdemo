<?php

namespace App\Livewire;

use App\Models\NewsletterSubscriber;
use Illuminate\View\View;
use Livewire\Component;

class Newslettersignup extends Component
{
    public bool $compact = false;

    public string $email = '';

    public bool $consent = false;

    /** 'idle' | 'success' | 'already' | 'error' */
    public string $state = 'idle';

    protected function rules(): array
    {
        return [
            'email' => 'required|email|max:255',
            'consent' => 'accepted',
        ];
    }

    protected function messages(): array
    {
        return [
            'consent.accepted' => 'You must agree to receive emails from KWDT.',
        ];
    }

    public function subscribe(): void
    {
        $this->validate();

        $existing = NewsletterSubscriber::where('email', $this->email)->first();

        if ($existing) {
            if (! $existing->is_active) {
                $existing->resubscribe();
                $this->state = 'success';
            } else {
                $this->state = 'already';
            }

            return;
        }

        NewsletterSubscriber::create([
            'email' => $this->email,
            'unsubscribe_token' => NewsletterSubscriber::generateToken(),
            'is_active' => true,
            'subscribed_at' => now(),
        ]);

        $this->state = 'success';
        $this->email = '';
    }

    public function render(): View
    {
        return view('livewire.newsletter-signup');
    }
}
