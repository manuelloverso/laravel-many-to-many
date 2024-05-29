<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //dd(Project::find(6)->with('technologies'));
        //dd(Project::all());
        $projects = Project::orderByDesc('id')->get();
        $technologies = Technology::all();

        //filtered
        return view('admin.projects.index', compact('projects', 'technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        //dd($request->all());
        $val_data = $request->validated();
        $slug = Str::slug($request->title, '-');
        $val_data['slug'] = $slug;
        //image
        //dd($val_data);
        if ($request->has('image')) {
            $img_path = Storage::put('uploads', $val_data['image']);
            $val_data['image'] = $img_path;
        }
        $project = Project::create($val_data);
        if ($request->has('technologies')) {
            $project->technologies()->attach($val_data['technologies']);
        }
        return to_route('admin.projects.show', compact('project'))->with('message', 'Project created succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //dd($request->all());
        $val_data = $request->validated();
        $slug = Str::slug($request->title, '-');
        $val_data['slug'] = $slug;


        //image ok
        //check if the request is submitted with an image
        if ($request->has('image')) {
            //check if the project already had another image
            if ($project->image) {
                //if so we delete it
                Storage::delete($project->image);
            }
            $img_path = Storage::put('uploads', $val_data['image']);
            //dd($validated, $image_path);
            $val_data['image'] = $img_path;
        }

        //dd($val_data);
        $project->update($val_data);
        if ($request->has('technologies')) {
            $project->technologies()->sync($val_data['technologies']);
        } else {
            $project->technologies()->sync([]);
        }
        return to_route('admin.projects.show', compact('project'))->with('message', 'Project updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::delete($project->image);
        }
        //$project->technologies()->detach();
        $project->delete();
        return to_route('admin.projects.index')->with('message', 'Project deleted succesfully');
    }
}
