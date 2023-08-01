<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\GradeLevelController;
use App\Http\Controllers\SectionController;


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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('departments', DepartmentController::class)->only(
        [
            'index', 'show'
        ])->names(
        [
            'index' => 'departments.all'
        ]);
    Route::resource('gradeLevels', GradeLevelController::class)->only(
        [
            'index', 'show'
        ])->names(
        [
            'index' => 'gradeLevels.all'
        ]);

    Route::resource('sections', SectionController::class)->only(
        [
            'index', 'show'
        ])->names(
        [
            'index' => 'sections.all'
        ]);
});

require __DIR__.'/auth.php';
