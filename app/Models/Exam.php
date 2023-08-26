<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_subject',
        'exam_date',
        'exam_duration',
        'class_id',
    ];

    public function Classes()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}
