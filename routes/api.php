<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\GradeLevelController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function (){
    // Department Route
    Route::apiResource('departments', DepartmentController::class)->except(['show']);
    Route::delete('/departments', [DepartmentController::class, 'destroyAll'])->name('departments.destroyAll');
    // Grade Level Route
    Route::apiResource('gradeLevels', GradeLevelController::class)->except(['show']);
    Route::delete('/gradeLevels', [GradeLevelController::class, 'destroyAll'])->name('gradeLevels.destroyAll');

    // Section Route
    Route::apiResource('sections', SectionController::class)->except(['show']);
    Route::delete('/sections', [SectionController::class, 'destroyAll'])->name('sections.destroyAll');

    // Subject Route
    Route::apiResource('subjects', SubjectController::class)->except(['show']);
    Route::delete('/subjects', [SubjectController::class, 'destroyAll'])->name('subjects.destroyAll');

    // User
    Route::apiResource('users', UserController::class)->except(['show']);
    Route::delete('/users', [UserController::class, 'destroyAll'])->name('users.destroyAll');

});
