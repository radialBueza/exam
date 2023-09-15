<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActiveExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'user_id' => $this->user_id,
            'user_name' => $this->user->name,
            'subject_id' => $this->subject_id,
            'subject_name' => $this->subject->name,
            'grade_level_id' => $this->grade_level_id,
            'description' => $this->description,
            'num_of_questions' => $this->num_of_questions,
            'is_active' => $this->is_active,
            'time_limit' => $this->time_limit,
        ];
    }
}
