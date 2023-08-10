<?php

namespace App\Models;

use App\Models\Classes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'note_subject',
        'note_date',
        'note_file',
        'class_id',
    ];

    public function classes()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}
