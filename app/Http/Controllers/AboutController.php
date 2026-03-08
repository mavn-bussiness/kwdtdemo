<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\Partner;
use App\Models\TeamMember;
use App\Models\ThematicArea;

class AboutController extends Controller
{

    public function index()
    {
        $history = config('kwdt.about');

        $members = TeamMember::active()->orderBy('order')->get();
        $partners = Partner::active()->orderBy('order')->get();

        return view('pages.about.index', compact('history', 'members', 'partners'));
    }

    /**
     * What We Do page shows thematic areas.
     */
    public function whatWeDo()
    {
        $areas = ThematicArea::orderBy('order')->get();

        return view('pages.about.what-we-do', compact('areas'));
    }

    /**
     * Awards listing. Kept separate since route points here.
     */
    public function awards()
    {
        $awards = Award::orderBy('year', 'desc')->get();

        return view('pages.about.awards', compact('awards'));
    }
}
