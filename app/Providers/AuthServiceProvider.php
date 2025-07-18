<?php

namespace App\Providers;

use App\Models\Exam;
use App\Models\Question;
use App\Models\User;
use App\Policies\ExamPolicy;
use App\Policies\QuestionPolicy;
use App\Policies\ExamAttemptPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Exam::class => ExamPolicy::class,
        Question::class => QuestionPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('admin', function(User $user) {
            return $user->account_type == 'admin'
                            ? Response::allow()
                            : Response::denyAsNotFound();
        });

        Gate::define('teacherOrAdvisor', function(User $user) {
            return $user->account_type == 'advisor' || $user->account_type == 'teacher';
        });

        Gate::define('teacher', function(User $user) {
            return $user->account_type == 'teacher';
        });


        Gate::define('student', function(User $user) {
            return $user->account_type == 'student'
                            ? Response::allow()
                            : Response::denyAsNotFound();
        });

        Gate::define('advisor', function(User $user) {
            return $user->account_type == 'advisor'
                            ? Response::allow()
                            : Response::denyAsNotFound();
        });

        Gate::define('pickSection', function(User $user, User $userModel) {
            return $user->id == $userModel->id
                            ? Response::allow()
                            : Response::denyAsNotFound();
        });

        Gate::define('viewAny-exam', [ExamPolicy::class, 'viewAny']);

        Gate::define('view-exam', [ExamPolicy::class, 'view']);

        Gate::define('view-question', [QuestionPolicy::class, 'view']);

        Gate::define('view-examAttempt', [ExamAttemptPolicy::class, 'view']);

        Gate::define('update-attempt', [ExamAttemptPolicy::class, 'update']);

        Gate::define('take-exam', function (User $user, Exam $exam) {
            if ($exam->subject_id == 6) {
                return Response::allow();
            }
            $gradeUser = $user->section->gradeLevel->id;
            $gradeExam = $exam->gradeLevel->id;
            // dd($gradeExam);
            return $gradeUser === $gradeExam
                ? Response::allow()
                : Response::denyAsNotFound();
        });

    }
}
