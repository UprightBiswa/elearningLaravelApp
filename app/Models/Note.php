<?php

namespace App\Models;

use App\Models\Classes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'note_subject',
        'note_date',
        'note_file',
        'class_id',
    ];
    public function getNoteFileUrlAttribute()
    {
        // Use the asset() helper function to generate the URL
        // Note: asset() is relative to the public directory
        return asset($this->attributes['note_file']);
    }


    public function classes()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}
