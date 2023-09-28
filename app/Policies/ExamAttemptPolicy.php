<?php

namespace App\Policies;

use App\Models\ExamAttempt;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ExamAttemptPolicy
{

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ExamAttempt $examAttempt): Response
    {
        return ($user->account_type == 'admin'
        || $examAttempt->user_id == $user->id
        || $examAttempt->exam->user_id == $user->id
        || ($user->account_type == 'advisor' && $examAttempt->user->section_id == $user->section_id))
                            ? Response::allow()
                            : Response::denyAsNotFound();
    }


    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ExamAttempt $examAttempt): bool
    {
        return ($user->account_type == 'admin' || $examAttempt->user_id == $user->id);
    }

}
