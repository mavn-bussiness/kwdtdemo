<?php

namespace App\Http\Controllers;

use App\Models\Donation;

class DonateController extends Controller
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
        return redirect(route('donate.paypal', $donation));
    }
}
