<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmallGroupMember extends Model
{
    protected $fillable = [
        'small_group_id',
        'user_id',
        'role',
        'joined_at',
    ];

    protected $casts = [
        'joined_at' => 'datetime',
    ];

    public function smallGroup()
    {
        return $this->belongsTo(SmallGroup::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
