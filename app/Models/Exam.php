<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject_id',
        'grade_level_id',
        'name',
        'description',
        'instructions',
        'num_of_question',
        'is_active',
        'time_limit',
    ];

    protected $casts = [
        'created_at' => 'datetime:M/d/Y',
        'time_limit' => 'datetime:H:i',
        'is_active' => 'boolean'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function gradeLevel(): BelongsTo
    {
        return $this->belongsTo(GradeLevel::class);
    }
}
