<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamAttemptResource extends JsonResource
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
            'user_name' => $this->user->name,
            'exam_name' => $this->exam->name,
            'grade_level_name' => $this->exam->grade_level_id !== null ? $this->exam->gradeLevel->name : null,
            'subject' => $this->exam->subject->name,
            'score' => $this->score,
            'percent' => $this->percent,
            'grade' => $this->grade,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ];
    }
}
