<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SermonComment extends Model
{
    use HasFactory;

    protected $fillable = ['sermon_id','user_id','name','email','content','approved'];

    public function sermon()
    {
        return $this->belongsTo(Sermon::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
