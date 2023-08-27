<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamResource extends JsonResource
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
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
            'subject_id' => $this->subject->id,
            'subject_name' => $this->subject->name,
            'grade_level_id' => $this->gradeLevel->id,
            'grade_level_name' => $this->gradeLevel->name,
            'name' => $this->name,
            'description' => $this->description,
            'num_of_questions' => $this->num_of_questions,
            'is_active' => $this->is_active,
            'time_limit' => $this->time_limit,
            'created_at' => $this->created_at->format('M/d/Y')
        ];
    }
}
