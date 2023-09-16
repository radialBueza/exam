<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\GradeLevelController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ExamAttemptController;
use App\Models\ExamAttempt;

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
    Route::apiResource('departments', DepartmentController::class);
    Route::delete('/departments', [DepartmentController::class, 'destroyAll'])->name('departments.destroyAll');
    Route::post('/departments/{department}', [DepartmentController::class, 'createFor'])->name('departments.createFor');
    Route::put('/departments/{department}/{gradeLevel}', [DepartmentController::class, 'updateFor']);

    // Grade Level Route
    Route::apiResource('gradeLevels', GradeLevelController::class);
    Route::delete('/gradeLevels', [GradeLevelController::class, 'destroyAll'])->name('gradeLevels.destroyAll');
    Route::post('/gradeLevels/{gradeLevel}', [GradeLevelController::class, 'createFor'])->name('gradeLevels.createFor');
    Route::put('/gradeLevels/{gradeLevel}/{section}', [GradeLevelController::class, 'updateFor']);

    // Section Route
    Route::apiResource('sections', SectionController::class);
    Route::delete('/sections', [SectionController::class, 'destroyAll'])->name('sections.destroyAll');

    // Subject Route
    Route::apiResource('subjects', SubjectController::class);
    Route::delete('/subjects', [SubjectController::class, 'destroyAll'])->name('subjects.destroyAll');

    // User
    Route::apiResource('users', UserController::class);
    Route::delete('/users', [UserController::class, 'destroyAll'])->name('users.destroyAll');

    Route::prefix('tests')->group(function () {
        // Exam
        Route::apiResource('tests/exams', ExamController::class);
        Route::delete('tests/exams', [ExamController::class, 'destroyAll'])->name('exams.destroyAll');
        Route::post('tests/exams/{exam}', [ExamController::class, 'createFor'])->name('exams.createFor');
        Route::put('tests/exams/{exam}/activate', [ExamController::class, 'activate'])->name('exams.activate');
        Route::put('tests/exams/{exam}/{question}', [ExamController::class, 'updateFor']);
        // Question
        Route::prefix('exams')->group(function () {
            Route::apiResource('questions', QuestionController::class);
            Route::delete('/questions', [QuestionController::class, 'destroyAll'])->name('questions.destroyAll');
        });
        // Result
        Route::get('/testResults', [ExamAttemptController::class, 'index'])->name('testExamAttempt.index');
    });


    // Test Results Search
    Route::get('/testResults', [ExamAttemptController::class, 'index'])->name('examAttempt.index');

    // Route::apiResource('testResults', ExamAttemptController::class)->only(['index', 'destroy']);

});
