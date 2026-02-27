<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class SermonSeries extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image_url',
        'start_date',
        'end_date',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($series) {
            if (empty($series->slug)) {
                $series->slug = Str::slug($series->title);
            }
        });

        static::updating(function ($series) {
            if ($series->isDirty('title') && empty($series->slug)) {
                $series->slug = Str::slug($series->title);
            }
        });
    }

    public function sermons()
    {
        return $this->hasMany(Sermon::class, 'series_id')->orderBy('series_order')->orderBy('date', 'desc');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('start_date', 'desc');
    }

    public function getSermonCountAttribute()
    {
        return $this->sermons()->count();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
