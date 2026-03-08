<?php

namespace App\Http\Controllers;

class CareerController extends Controller
{
    public function index()
    {
        // use Career model instead of content pages
        $jobs = \App\Models\Career::where('is_active', true)
            ->where('status', 'open')
            ->orderByDesc('posted_at')
            ->get();

        return view('pages.careers', compact('jobs'));
    }
}
