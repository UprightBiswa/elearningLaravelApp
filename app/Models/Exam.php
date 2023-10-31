<?php

namespace App\Models;

use App\Models\Classes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
