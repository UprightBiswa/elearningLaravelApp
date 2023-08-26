<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_text',
        'exam_id',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    public function AnswerOption()
    {
        return $this->hasMany(AnswerOption::class);
    }
}
