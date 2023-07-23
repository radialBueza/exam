<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;


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
    // Route::get('/departments', [DepartmentController::class, 'index'])->name('dept');
    Route::apiResource('departments', DepartmentController::class);
    Route::delete('/departments', [DepartmentController::class, 'destroyAll'])->name('departments.destroyAll');
});
