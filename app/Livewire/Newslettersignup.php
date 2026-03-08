<?php

namespace App\Livewire;

use App\Models\NewsletterSubscriber;
use Livewire\Component;

class Newslettersignup extends Component
{
    public bool $compact = false; // compact = footer version

    public string $email = '';

    public string $state = 'idle'; // 'idle' | 'success' | 'already' | 'error'

    protected function rules(): array
    {
        return ['email' => 'required|email|max:255'];
    }

    public function subscribe(): void
    {
        $this->validate();

        $existing = NewsletterSubscriber::where('email', $this->email)->first();

        if ($existing) {
            if (! $existing->is_active) {
                // Re-subscribe
                $existing->resubscribe();
                $this->state = 'success';
            } else {
                $this->state = 'already';
            }

            return;
        }

        NewsletterSubscriber::create([
            'email' => $this->email,
            'is_active' => true,
            'subscribed_at' => now(),
        ]);

        $this->state = 'success';
        $this->email = '';
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.newsletter-signup');
    }
}
