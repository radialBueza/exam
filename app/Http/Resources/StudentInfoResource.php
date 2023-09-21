<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $advisor = $this->section->users()->where('account_type', 'admin')->orWhere('account_type', 'advisor')->first();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'account_type' => $this->account_type,
            'email' => $this->email,
            // 'gender' => $this->gender == 1 ? 'Male' : 'Female,
            'birthday' => $this->birthday->format('M/d/Y'),
            'section' => $this->section->name,
            'advisor' => empty($advisor) ? null : $advisor->name,
            'isGamer' => $this->surveys()->latest()->first()->is_gamer == 1 ? 'Yes' : 'No'
        ];
    }
}
