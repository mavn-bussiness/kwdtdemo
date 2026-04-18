<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $query = Project::with('content')
            ->whereHas('content', fn($q) => $q->published());

        if ($status = request('status')) {
            $query->where('status', $status);
        }

        $projects = $query->latest()->paginate(9);

        return view('pages.projects.index', compact('projects'));
    }

    public function show(string $slug)
    {
        $content = Content::published()
            ->where('slug', $slug)
            ->with(['project', 'media', 'categories'])
            ->firstOrFail();

        $project = $content->project;

        abort_if(is_null($project), 404);

        return view('pages.projects.show', compact('project', 'content'));
    }
}
