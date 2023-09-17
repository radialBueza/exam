<?php

namespace App\Policies;

use App\Models\ExamAttempt;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ExamAttemptPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    // public function viewAny(User $user): bool
    // {

    // }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ExamAttempt $examAttempt): Response
    {
        return ($user->account_type == 'admin' || $examAttempt->user_id == $user->id  || $examAttempt->exam->user_id == $user->id)
                            ? Response::allow()
                            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can create models.
     */
    // public function create(User $user): bool
    // {

    // }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ExamAttempt $examAttempt): bool
    {
        return ($user->account_type == 'admin' || $examAttempt->user_id == $user->id);
    }
    /**
     * Determine whether the user can delete the model.
     */
    // public function delete(User $user, ExamAttempt $examAttempt): bool
    // {

    // }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, ExamAttempt $examAttempt): bool
    // {

    // }

    /**
     * Determine whether the user can permanently delete the model.
     */
    // public function forceDelete(User $user, ExamAttempt $examAttempt): bool
    // {

    // }
}
