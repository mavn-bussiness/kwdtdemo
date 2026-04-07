<?php

namespace App\Livewire;

use App\Mail\ContactFormSubmitted;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name = '';

    public string $email = '';

    public string $subject = '';

    public string $message = '';

    public string $state = 'idle'; // 'idle' | 'success' | 'error'

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:20|max:2000',
        ];
    }

    public function send(): void
    {
        $this->validate();

        try {
            Mail::to(config('mail.from.address'))->send(
                new ContactFormSubmitted(
                    name: $this->name,
                    email: $this->email,
                    emailSubject: $this->subject,
                    message: $this->message,
                )
            );

            $this->state = 'success';
            $this->reset(['name', 'email', 'subject', 'message']);

        } catch (\Exception $e) {
            $this->state = 'error';
            \Log::error('Contact form failed', ['error' => $e->getMessage()]);
        }
    }

    public function render(): View
    {
        return view('livewire.contact-form');
    }
}
