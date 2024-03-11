<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\User;
use App\Models\Exam;
use Illuminate\Auth\Access\Response;

class QuestionPolicy
{

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Question $question): Response
    {
        return ($user->account_type == 'admin' || $question->exam->user_id == $user->id)
                            ? Response::allow()
                            : Response::denyAsNotFound();

    }


    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Exam $exam): Response
    {
        return ($user->account_type == 'admin' || $exam->user_id == $user->id)
                            ? Response::allow()
                            : Response::denyAsNotFound();


    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Question $question): Response
    {
        return ($user->account_type == 'admin' || $question->user_id == $user->id)
                            ? Response::allow()
                            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Question $question): Response
    {
        return ($user->account_type == 'admin' || $question->user_id == $user->id)
                        ? Response::allow()
                        : Response::denyAsNotFound();
    }


}
