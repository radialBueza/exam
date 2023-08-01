<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function gradeLevel(): HasMany
    {
        return $this->hasMany(GradeLevel::class);
    }

    public function user(): HasOne
    {
        return $this->HasOne(User::class);
    }

}
