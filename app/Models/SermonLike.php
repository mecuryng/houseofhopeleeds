<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SermonLike extends Model
{
    use HasFactory;

    protected $fillable = ['sermon_id','user_id','session_id','ip'];

    public function sermon()
    {
        return $this->belongsTo(Sermon::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
