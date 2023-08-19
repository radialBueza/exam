<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\GradeLevelController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;


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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // departments
    Route::get('/departments', [DepartmentController::class, 'all'])->name('departments.all');
    Route::get('/departments/{department}', [DepartmentController::class, 'see']);

    // grade levels
    Route::get('/gradeLevels', [GradeLevelController::class, 'all'])->name('gradeLevels.all');
    Route::get('/gradeLevels/{gradeLevel}', [GradeLevelController::class, 'see']);

    // sections
    Route::get('/sections', [SectionController::class, 'all'])->name('sections.all');
    Route::get('/sections/{section}', [SectionController::class, 'see']);

    // subjects
    Route::get('/subjects', [SubjectController::class, 'all'])->name('subjects.all');
    Route::get('/subjects/{subject}', [SubjectController::class, 'see']);

    // resource
    Route::get('/users', [UserController::class, 'all'])->name('users.all');
    Route::get('/users/{user}', [UserController::class, 'see']);
});

Route::get('/mail', function(){
    $password = Illuminate\Support\Str::random();
    $name = 'clark kent';

    return new App\Mail\AccountCreated($password, $name);
});
require __DIR__.'/auth.php';
