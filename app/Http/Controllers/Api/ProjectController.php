<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;


class ProjectController extends Controller
{
    public function index(Request $request)
    {

        $projects = Project::with( "types", "technologies")->paginate(20);

        return response()->json($projects);
        
    }

    /* public function show($id) {
        $post = Post::with("user", "category", "tags")->findOrFail($id);
        return response()->json($post);
    } */

    public function show(Project $project)
    {
        // come il with() caricare i dati di queste relazioni,
        // dopo aver eseguito la query principale
        $project->load("types", "technologies");

        return response()->json($project);
    }
}
