<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        $technologies = Technology::all();
        $types = Type::all();
        return view('admin.dashboard', compact('projects', 'technologies', 'types'));
    }
}
