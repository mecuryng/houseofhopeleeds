<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reflection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'date',
        'user_id',
        'image_path',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(ReflectionComment::class);
    }

    public function likes()
    {
        return $this->hasMany(ReflectionLike::class);
    }
}
