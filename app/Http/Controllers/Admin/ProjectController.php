<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProjectRequest;
use App\Http\Requests\Admin\UpdateProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;

use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        $types = Type::all();

        return view("admin.projects.index",[
            "projects" => $projects,
            "types"=>$types

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies= Technology::all();

        return view("admin.projects.create",[
            "types"=>$types,
            "technologies"=>$technologies
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();

        if(key_exists("img_cover", $data)){

            $path = Storage::put("projects", $data["img_cover"]);
        }
        $singleProject = Project::create([
                ...$data,
                "img_cover"=> $path ?? '',
                "user_id"=> Auth::id()
        ]);

        if($request->has("technologies")){
            $singleProject->technologies()->attach($data["technologies"]);
        }

        return redirect()->route("admin.projects.show", $singleProject->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $types = Type::all();
        
        return view("admin.projects.show", compact("project","types"));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();


        return view("admin.projects.edit", [
            "project" => $project,
            "types"=>$types,
            "technologies"=>$technologies
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $path = null;
        $data = $request->validated();

        if($request->hasFile('img_cover')){

            $path =Storage::put("projects", $data['img_cover']);

            // Storage::delete($project-> img_cover);
        }

        $project->update([
            ...$data,

            'img_cover'=> $path ?? $project->img_cover

        ]);

        $project->technologies()->sync($data["technologies"]);

        return redirect()-> route("admin.projects.show", $project->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        if($project->img_cover){
            Storage::delete($project->img_cover);
        }
        $project->technologies()->detach();

        $project ->delete();

        return redirect()->route("admin.projects.index");
    }
}
