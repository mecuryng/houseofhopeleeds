<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DonationGoal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'target_amount',
        'current_amount',
        'start_date',
        'end_date',
        'is_active',
        'show_progress',
        'color',
    ];

    protected $casts = [
        'target_amount' => 'decimal:2',
        'current_amount' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
        'show_progress' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeCurrent($query)
    {
        return $query->where('start_date', '<=', now())
            ->where(function ($q) {
                $q->whereNull('end_date')
                    ->orWhere('end_date', '>=', now());
            });
    }

    public function getProgressPercentageAttribute()
    {
        if ($this->target_amount <= 0) {
            return 0;
        }
        return min(100, round(($this->current_amount / $this->target_amount) * 100, 1));
    }

    public function getRemainingAmountAttribute()
    {
        return max(0, $this->target_amount - $this->current_amount);
    }

    public function getIsCompletedAttribute()
    {
        return $this->current_amount >= $this->target_amount;
    }
}
