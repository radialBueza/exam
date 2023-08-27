<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'exam_id',
        'question',
        'question_file',
        'a',
        'a_file',
        'b',
        'b_file',
        'c',
        'c_file',
        'd',
        'd_file',
        'correct_answer'
    ];

    protected $casts = [
        'created_at' => 'datetime:M/d/Y',
    ];

    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }

}
