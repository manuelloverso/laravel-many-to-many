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
        return view('admin.technologies.create');
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
        return to_route('admin.technologies.index')->with('message', 'Type created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
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
        return to_route('admin.technologies.index')->with('message', 'type deleted successfully');
    }
}
