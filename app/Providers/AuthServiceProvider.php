<?php

namespace App\Providers;

use App\Models\Exam;
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

        // Gate::define('not-student', function(User $user) {
        //     return $user->account_type != 'student';
        // });

        Gate::define('student', function(User $user) {
            return $user->account_type == 'student'
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

    }
}
