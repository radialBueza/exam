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
    Route::resource('departments', DepartmentController::class)->only([
        'index', 'show'
    ])->names([
        'index' => 'departments.all'
    ]);

    Route::resource('gradeLevels', GradeLevelController::class)->only([
        'index', 'show'
    ])->names([
        'index' => 'gradeLevels.all'
    ]);

    Route::resource('sections', SectionController::class)->only([
        'index', 'show'
    ])->names([
        'index' => 'sections.all'
    ]);

    Route::resource('subjects', SubjectController::class)->only([
        'index', 'show'
    ])->names([
        'index' => 'subjects.all'
    ]);

    Route::resource('users', UserController::class)->only([
        'index', 'show'
    ])->names([
        'index' => 'users.all'
    ]);
});

Route::get('/mail', function(){
    $password = Illuminate\Support\Str::random();
    $name = 'clark kent';

    return new App\Mail\AccountCreated($password, $name);
});
require __DIR__.'/auth.php';
