<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use Illuminate\Support\Str;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        $val_data = $request->validated();
        $slug = Str::slug($request->name, '-');
        $val_data['slug'] = $slug;
        //dd($val_data);
        Type::create($val_data);
        return to_route('admin.types.index')->with('message', 'Type created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        // LEAVING THIS EMPTY AS THERE IS NOTHING TO SHOW, THE TYPE ONLY HAS A NAME
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        $types = Type::all();
        $editing_type = $type;
        return view('admin.types.index', compact('editing_type', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        //dd($request->all());
        $val_data = $request->validated();
        $slug = Str::slug($request->name, '-');
        $val_data['slug'] = $slug;
        $type->update($val_data);
        return to_route('admin.types.index')->with('message', 'Type Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return to_route('admin.types.index')->with('message', 'type deleted successfully');
    }
}
