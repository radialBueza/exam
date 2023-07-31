<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Department;

class GradeLevelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $dept = Department::find($this->department_id);
        return [
            'id' => $this->id,
            'department_id' => $dept->id,
            'department_name' => $dept->name,
            'name' => $this->name,
            'created_at' => $this->created_at,
        ];
    }
}
