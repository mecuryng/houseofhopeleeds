<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class SmallGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'leader_id',
        'location',
        'meeting_day',
        'meeting_time',
        'max_members',
        'is_open',
        'category',
    ];

    protected $casts = [
        'is_open' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($group) {
            if (empty($group->slug)) {
                $group->slug = Str::slug($group->name);
            }
        });
    }

    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'small_group_members')
            ->withPivot('role', 'joined_at')
            ->withTimestamps();
    }

    public function scopeOpen($query)
    {
        return $query->where('is_open', true);
    }

    public function getMemberCountAttribute()
    {
        return $this->members()->count();
    }

    public function getIsFullAttribute()
    {
        return $this->member_count >= $this->max_members;
    }

    public function hasMember($userId)
    {
        return $this->members()->where('user_id', $userId)->exists();
    }
}
