<?php

namespace App\Http\Controllers;

use App\Models\Donation;

class DonateController
{
    public function index()
    {
        return view('pages.donate');
    }

    /**
     * Redirect to the correct payment gateway after Livewire form submission.
     * Each gateway has its own Service class (to be built in phase 2).
     */
    public function gateway(Donation $donation)
    {
        return match ($donation->payment_method) {
            'paypal' => redirect(route('donate.paypal', $donation)),
            'mtn_momo' => redirect(route('donate.mtn', $donation)),
            'airtel_money' => redirect(route('donate.airtel', $donation)),
            default => redirect(route('donate'))->with('error', 'Unknown payment method.'),
        };
    }
}
