<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\GradeLevel;

class SectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $gradeLevel = GradeLevel::find($this->grade_level_id);
        return [
            'id' => $this->id,
            'grade_level_id' => $gradeLevel->id,
            'grade_level_name' => $gradeLevel->name,
            'name' => $this->name,
            'created_at' => $this->created_at,
        ];
    }
}
