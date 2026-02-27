<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsletterSubscriber extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'email',
        'name',
        'is_active',
        'subscribed_at',
        'unsubscribed_at',
        'unsubscribed_reason',
        'source',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'subscribed_at' => 'datetime',
        'unsubscribed_at' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function unsubscribe(?string $reason = null): void
    {
        $this->update([
            'is_active' => false,
            'unsubscribed_at' => now(),
            'unsubscribed_reason' => $reason,
        ]);
    }

    public function resubscribe(): void
    {
        $this->update([
            'is_active' => true,
            'subscribed_at' => now(),
            'unsubscribed_at' => null,
            'unsubscribed_reason' => null,
        ]);
    }
}
