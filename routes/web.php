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
use App\Http\Controllers\SurveyController;
use App\Http\Middleware\CheckSection;
use App\Http\Middleware\CheckSurvey;
use App\Http\Controllers\MyStudentController;
use App\Http\Controllers\StatisticController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::redirect('/', '/login');


// , 'cache.headers:no_store'
Route::get('/dashboard', [Dashboard::class, 'index'])->middleware(['auth', 'verified', CheckSurvey::class])->name('dashboard');

Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::middleware(['can:admin', 'cache.headers:no_store'])->group(function() {
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

        // users
        Route::get('/users', [UserController::class, 'all'])->name('users.all');
        Route::get('/users/{user}', [UserController::class, 'see']);
    });


    // Route::middleware('cache.headers:no_store')->group(function () {
        //exam
        Route::get('/exams', [ExamController::class, 'all'])->name('exams.all')->middleware('can:viewAny-exam');
        Route::get('/exams/{exam}', [ExamController::class, 'see'])->middleware('can:view-exam,exam');

        // question
        Route::prefix('exams')->group(function () {
            // Route::get('/questions', function () {
            //     return abort(404);
            // })->name('questions.all');
            Route::get('/questions/{question}', [QuestionController::class, 'see'])->middleware('can:view-question,question');
        });

        // Route::get('/studentResult/', [ExamAttemptController::class, 'all'])->name('testsExamAttempt.all');
        // Route::get('/studentResult/{examAttempt}', [ExamAttemptController::class, 'show'])->name('studentExamAttempt.show')->middleware('can:view-examAttempt,examAttempt');
    // });


    Route::middleware('can:student')->group(function(){
        //get student's section
        // Route::get('/student/picksection', [PickSection::class, 'index'])->name('pickSection');
        // Route::put('/student/picksection/{user}', [PickSection::class, 'setSection'])->name('setSection')->middleware('can:pickSection,user');
        Route::get('/survey', [SurveyController::class, 'create'])->name('survey');
        Route::post('/survey/{user}', [SurveyController::class, 'store'])->name('recordSurvey');

        Route::middleware(CheckSurvey::class)->group(function() {
            // take exam
            Route::get('/take-exam/{exam}', [TakeExam::class, 'index'])->name('exam')->middleware(['cache.headers:no_store', 'can:take-exam,exam']);
            // Route::get('/takeExam/{exam}', [TakeExam::class, 'index'])->name('exam')->middleware('cache.headers:no_store');

            Route::put('/take-exam/{exam}/{attempt}', [TakeExam::class, 'gradeExam'])->name('gradeExam')->middleware('can:update-attempt,attempt');

            // Exam Results
            Route::get('/result', [ExamAttemptController::class, 'all'])->name('examAttempt.all');

            // Route::resource('survey', [SurveyController::class])->only(['create', 'store']);
        });
    });

    Route::middleware('can:teacherOrAdvisor')->group(function() {
        Route::get('/examResult/{exam}', [ExamAttemptController::class, 'allExams'])->name('techerAttempt.all')->middleware('can:view-exam,exam');
    });

    Route::middleware('can:advisor')->group(function() {
        Route::get('/my-students', [MyStudentController::class, 'all'])->name('myStudent.all');
        Route::get('/my-students/{myStudents}', [MyStudentController::class, 'see'])->name('myStudent.see');
        // Route::get('/myStudents/result/{examAttempt}', [ExamAttemptController::class, 'show'])->name('myStudentExamAttempt.show')->middleware('can:view-examAttempt,examAttempt');;
    });

    // Route::get('/result/{examAttempt}', [ExamAttemptController::class, 'show'])->name('examAttempt.show')->middleware('can:view-examAttempt,examAttempt');

    Route::get('/result/{examAttempt}/{where?}', [ExamAttemptController::class, 'result'])->name('examAttempt.result')->middleware('can:view-examAttempt,examAttempt');

    Route::get('/stat', [StatisticController::class, 'index'])->name('stat');
    Route::get('stat/correlation-pdf', [StatisticController::class, 'pdfCorrelation'])->name('correlationPdf');
    Route::get('stat/gamer-vs-non-gamer-pdf', [StatisticController::class, 'pdfGamerVsNongamer'])->name('gamersVsPdf');
    Route::get('stat/male-vs-female-pdf', [StatisticController::class, 'pdfMaleVsFemale'])->name('maleVsPdf');
    Route::get('stat/frequency-pdf', [StatisticController::class, 'pdfFrequency'])->name('freqPdf');


});

require __DIR__.'/auth.php';
