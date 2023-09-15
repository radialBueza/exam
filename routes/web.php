<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\GradeLevelController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\PickSection;
use App\Http\Controllers\TakeExam;
use App\Http\Controllers\ExamAttemptController;
use App\Http\Middleware\CheckSection;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [Dashboard::class, 'index'])->middleware(['auth', 'verified', 'cache.headers:no_store', CheckSection::class])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::middleware('can:admin')->group(function() {
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

        // users
        Route::get('/users', [UserController::class, 'all'])->name('users.all');
        Route::get('/users/{user}', [UserController::class, 'see']);
    });


    Route::prefix('tests')->group(function () {
        //exam
        Route::get('/exams', [ExamController::class, 'all'])->name('exams.all')->middleware('can:viewAny-exam');
        Route::get('/exams/{exam}', [ExamController::class, 'see'])->middleware('can:view-exam,exam');

        // question
        Route::prefix('exams')->group(function () {
            Route::get('/questions', function () {
                return;
            })->name('questions.all');
            Route::get('/questions/{question}', [QuestionController::class, 'see']);
        });
    });


    Route::middleware('can:student')->group(function(){
        //get student's section
        Route::get('/student/picksection', [PickSection::class, 'index'])->name('pickSection');
        Route::put('/student/picksection/{user}', [PickSection::class, 'setSection'])->name('setSection');

        Route::middleware(CheckSection::class)->group(function() {
            // take exam
            Route::get('/takeExam/{exam}', [TakeExam::class, 'index'])->name('exam')->middleware('cache.headers:no_store');
            Route::put('/takeExam/{exam}/{attempt}', [TakeExam::class, 'gradeExam'])->name('gradeExam');

            // Exam Results
            Route::get('/testResult/', [ExamAttemptController::class, 'all'])->name('examAttempt.all');
            Route::get('/testResult/{examAttempt}', [ExamAttemptController::class, 'show'])->name('examAttempt.show');
        });


    });
});


Route::get('/mail', function(){
    $password = Illuminate\Support\Str::random();
    $name = 'clark kent';

    return new App\Mail\AccountCreated($password, $name);
});
require __DIR__.'/auth.php';
