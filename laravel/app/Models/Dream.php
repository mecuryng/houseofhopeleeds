<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dream extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'attachment_path',
    ];

    /**
     * Poster relationship (admin or pastor user)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
