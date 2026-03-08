<?php

namespace App\Http\Controllers;

use App\Models\Report;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::with('content')
            ->whereHas('content', fn ($q) => $q->published())
            ->latestYear()          
            ->get()
            ->groupBy('report_year'); 

        return view('pages.reports', [
            'reports' => $reports,
        ]);
    }
}