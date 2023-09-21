<?php

namespace App\Policies;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ExamPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return ($user->account_type != 'student')
                            ? Response::allow()
                            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Exam $exam): Response
    {
        return ($user->account_type == 'admin' || $exam->user_id == $user->id)
                            ? Response::allow()
                            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return ($user->account_type != 'student')
                            ? Response::allow()
                            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Exam $exam): Response
    {
        return ($user->account_type == 'admin' || $exam->user_id == $user->id)
                            ? Response::allow()
                            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Exam $exam): bool
    {
        return ($user->account_type == 'admin' || $exam->user_id == $user->id);
    }

    public function activate(User $user, Exam $exam): bool
    {
        return ($user->account_type == 'admin' || $exam->user_id == $user->id);
    }

    /**
     * Destory many
     */
    // public function restore(User $user, Exam $exam): bool
    // {

    // }

    /**
     * Determine whether the user can permanently delete the model.
     */
    // public function forceDelete(User $user, Exam $exam): bool
    // {

    // }
}
