<?php

namespace App\Http\Controllers;

use App\Services\HomepageCache;

class HomeController extends Controller
{
    public function index()
    {
        $data = HomepageCache::get();

        return view('pages.home', [
            'featuredProjects' => $data['projects'],
            'latestBlogs' => $data['blogs'],
            'partners' => $data['partners'],
            'testimonials' => $data['testimonials'],
        ]);
    }
}
