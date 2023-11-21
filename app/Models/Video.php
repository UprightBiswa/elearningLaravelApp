<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'video_subject',
        'video_date',
        'video_file',
        'class_id',
    ];
    public function getVideoFileUrlAttribute()
    {
        // Use the asset() helper function to generate the URL
        // Note: asset() is relative to the public directory
        return asset($this->attributes['video_file']);
    }
    public function Classes()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}
