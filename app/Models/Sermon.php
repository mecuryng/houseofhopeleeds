<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sermon extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content', 'date_preached', 'pastor_id'
    ];

    public function pastor()
    {
        return $this->belongsTo(User::class, 'pastor_id');
    }
}

