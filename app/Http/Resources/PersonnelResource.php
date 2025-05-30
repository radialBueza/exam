<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonnelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($this->account_type == 'advisor') {
            $department = $this->section->gradeLevel->department->name;
        }else {
            $department = $this->department ? $this->department->name: null;
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'account_type' => $this->account_type,
            // 'email' => $this->email,
            // 'gender' => $this->gender == 1 ? 'Male' : 'Female,
            'birthday' => $this->birthday->format('M/d/Y'),
            'section' => $this->section !== null ? $this->section->name : null,
            'department' => $department,
        ];
    }
}
