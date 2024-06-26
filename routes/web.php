<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $projects = Project::all();
    $types = Type::all();
    return to_route('login');
});

// this one groups all the routes that need to be protected by the authentication
Route::middleware(['auth', 'verified'])
    ->name('admin.') //we put 'admin.' here because all the routes will start with admin.  (ex. admin.index)
    ->prefix('admin') // all the url's start with admin
    ->group(function () {
        //here we put all the routes that need to be protected
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('projects', ProjectController::class)->parameters([
            'projects' => 'project:slug'
        ]);
        Route::resource('types', TypeController::class)->parameters([
            'types' => 'type:slug'
        ]);
        Route::resource('technologies', TechnologyController::class)->parameters([
            'technologies' => 'technology:slug'
        ]);
    });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
