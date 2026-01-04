<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'date', 'time', 'location'
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function rsvps()
    {
        return $this->hasMany(Rsvp::class);
    }
}
