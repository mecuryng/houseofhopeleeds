<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sermon extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description', 
        'date', 
        'video_url', 
        'pastor_id',
        'series_id',
        'series_order',
        'bible_passage',
        'audio_url',
        'chapters',
        'duration',
        'thumbnail',
        'image_path',
    ];

    protected $casts = [
        'date' => 'date',
        'chapters' => 'array',
    ];

    public function pastor()
    {
        return $this->belongsTo(User::class, 'pastor_id');
    }

    public function series()
    {
        return $this->belongsTo(SermonSeries::class, 'series_id');
    }

    public function comments()
    {
        return $this->hasMany(SermonComment::class);
    }

    public function likes()
    {
        return $this->hasMany(SermonLike::class);
    }

    public function scopeInSeries($query, $seriesId)
    {
        return $query->where('series_id', $seriesId);
    }

    public function scopeStandalone($query)
    {
        return $query->whereNull('series_id');
    }

    public function getChaptersListAttribute()
    {
        if (empty($this->chapters)) {
            return [];
        }

        return collect($this->chapters)->map(function ($chapter) {
            return [
                'time' => $chapter['time'] ?? 0,
                'title' => $chapter['title'] ?? '',
                'time_formatted' => $this->formatTime($chapter['time'] ?? 0),
            ];
        })->toArray();
    }

    public function getCurrentChapter($seconds)
    {
        if (empty($this->chapters)) {
            return null;
        }

        $currentChapter = null;
        foreach ($this->chapters as $chapter) {
            if (($chapter['time'] ?? 0) <= $seconds) {
                $currentChapter = $chapter;
            }
        }

        return $currentChapter;
    }

    protected function formatTime($seconds)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $secs = $seconds % 60;

        if ($hours > 0) {
            return sprintf('%d:%02d:%02d', $hours, $minutes, $secs);
        }

        return sprintf('%d:%02d', $minutes, $secs);
    }
}
