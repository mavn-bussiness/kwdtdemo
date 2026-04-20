<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('order')->get();

        return view('pages.testimonials', compact('testimonials'));
    }
}
