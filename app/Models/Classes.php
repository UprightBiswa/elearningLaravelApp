<?php

namespace App\Models;

use App\Models\Exam;
use App\Models\Note;
use App\Models\Video;
use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classes extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        // Define the fillable attributes here
        'course_id',
        'class_name',
        'class_date',
        'class_time',

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Define the relationship with the Course model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function notes()
    {
        return $this->hasMany(Note::class, 'class_id');
    }
    public function videos()
    {
        return $this->hasMany(Video::class, 'class_id');
    }
    public function exams()
    {
        return $this->hasMany(Exam::class, 'class_id');
    }
}
