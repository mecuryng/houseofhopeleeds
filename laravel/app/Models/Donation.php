<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'donation_goal_id', 'provider', 'provider_id', 'amount', 'currency', 'frequency', 'status', 'email', 'metadata'
    ];

    protected $casts = [
        'metadata' => 'array',
        'amount' => 'integer',
    ];

    public function donationGoal()
    {
        return $this->belongsTo(DonationGoal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAmountInDollarsAttribute()
    {
        return $this->amount / 100;
    }
}
