<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'user_id', 'provider', 'provider_id', 'amount', 'currency', 'frequency', 'status', 'email', 'metadata'
    ];

    protected $casts = [
        'metadata' => 'array',
        'amount' => 'integer',
    ];
}
