<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReflectionComment extends Model
{
    use HasFactory;

    protected $fillable = ['reflection_id','user_id','name','email','content','approved'];

    public function reflection()
    {
        return $this->belongsTo(Reflection::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
