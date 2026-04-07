<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;

class NewsletterController extends Controller
{
    public function unsubscribe(string $token)
    {
        $subscriber = NewsletterSubscriber::where('unsubscribe_token', $token)
            ->where('is_active', true)
            ->first();

        if (! $subscriber) {
            return view('pages.newsletter-unsubscribe', ['status' => 'invalid']);
        }

        $subscriber->unsubscribe();

        return view('pages.newsletter-unsubscribe', ['status' => 'success', 'email' => $subscriber->email]);
    }
}
