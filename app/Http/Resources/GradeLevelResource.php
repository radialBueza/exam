<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GradeLevelResource extends JsonResource
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
            'department_id' => $this->department->id,
            'department_name' => $this->department->name,
            'name' => $this->name,
            'created_at' => $this->created_at->format('M/d/Y g:i:s A'),
        ];
    }
}
