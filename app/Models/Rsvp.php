<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Event;

class Rsvp extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id', 'name', 'email', 'guests_count', 'message'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
