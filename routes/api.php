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
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\MyStudentController;
use App\Http\Controllers\StatisticController;

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
    Route::middleware('can:admin')->group(function() {

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
        Route::apiResource('users', UserController::class)->except('show');
        Route::get('/users/{user}/{type?}', [UserController::class, 'show'])->name('users.show');
        Route::delete('/users', [UserController::class, 'destroyAll'])->name('users.destroyAll');
        Route::put('/retakeSurvey', [SurveyController::class, 'retake'])->name('retake');
        Route::put('/retakeSurvey/{user}', [SurveyController::class, 'retakeOne']);
    });
        Route::apiResource('exams', ExamController::class);
        Route::delete('/exams', [ExamController::class, 'destroyAll'])->name('exams.destroyAll');
        Route::post('/exams/{exam}', [ExamController::class, 'createFor'])->name('exams.createFor');
        Route::put('/exams/{exam}/activate', [ExamController::class, 'activate'])->name('exams.activate');
        Route::put('/exams/{exam}/{question}', [ExamController::class, 'updateFor']);
        // Question
        Route::prefix('exams')->group(function () {
            // Route::apiResource('questions', QuestionController::class);
            Route::get('/questions', function () {
                return;
            })->name('questions.index');
            Route::delete('/questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');
        });
        Route::delete('/questions', [QuestionController::class, 'destroyAll'])->name('questions.destroyAll');

        // Result
        // Route::get('/testResults', [ExamAttemptController::class, 'index'])->name('testExamAttempt.index');


    Route::middleware('can:student')->group(function(){
        // Test Results Search
        Route::get('/results', [ExamAttemptController::class, 'index'])->name('examAttempt.index');
    });

    Route::middleware('can:advisor')->group(function() {
        Route::get('/myStudents', [MyStudentController::class, 'index'])->name('myStudents.index');
        Route::get('/myStudents/{myStudents}', [MyStudentController::class, 'show'])->name('myStudents.show');
        // Route::get('/myStudent/{myStudents}', [MyStudentController::class, 'show'])->name('myStudent.show');
    });
    // Route::apiResource('testResults', ExamAttemptController::class)->only(['index', 'destroy']);

    Route::middleware('can:teacherOrAdvisor')->group(function(){
        // Test Results Search
        Route::get('/examResult/{exam}', [ExamAttemptController::class, 'searchAllExams'])->name('searchAllExams')->middleware('can:view-exam,exam');
    });

    // Route::get('stat', [StatisticController::class, 'getData'])->name('getData');
});


