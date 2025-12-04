<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sermon extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'date', 'video_url', 'pastor_id'
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function pastor()
    {
        return $this->belongsTo(User::class, 'pastor_id');
    }

    public function comments()
    {
        return $this->hasMany(SermonComment::class);
    }

    public function likes()
    {
        return $this->hasMany(SermonLike::class);
    }
}

