<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GradeLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'department_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:M/d/Y',
    ];

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }

}
