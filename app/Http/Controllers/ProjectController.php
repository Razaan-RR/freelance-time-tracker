<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;


class ProjectController extends Controller
{
    public function add(Request $request){
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|in:active,completed',
            'deadline' => 'required|date',
        ]);

        Project::create($request->all());
        return redirect('/dashboard');
    }

    public function updateStatus(Request $request, Project $project)
    {
        $request->validate([
            'status' => 'required|in:active,completed',
        ]);

        $project->status = $request->status;
        $project->save();

        return redirect('/dashboard')->with('success', 'Project status updated.');
    }

}
