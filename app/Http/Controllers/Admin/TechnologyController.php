<?php

namespace App\Http\Controllers\Admin;

use App\Models\Technology;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Adding new technologies directly from the index
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologyRequest $request)
    {
        $val_data = $request->validated();
        $slug = Str::slug($request->name, '-');
        $val_data['slug'] = $slug;
        //dd($val_data);
        Technology::create($val_data);
        return to_route('admin.technologies.index')->with('message', 'Technology added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        // There's not much to show
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        $technologies = Technology::all();
        $editing_tech = $technology;
        return view('admin.technologies.index', compact('editing_tech', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        //dd($request->all());
        $val_data = $request->validated();
        $slug = Str::slug($request->name, '-');
        $val_data['slug'] = $slug;
        $technology->update($val_data);
        return to_route('admin.technologies.index')->with('message', 'Technology Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->projects()->detach();
        $technology->delete();
        return to_route('admin.technologies.index')->with('message', 'Technology deleted successfully');
    }
}
