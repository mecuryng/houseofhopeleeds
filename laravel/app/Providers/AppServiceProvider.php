<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\Sermon;
use App\Observers\EventObserver;
use App\Observers\SermonObserver;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Schema::defaultStringLength(191);
        
        Event::observe(EventObserver::class);
        Sermon::observe(SermonObserver::class);

        RateLimiter::for('donations', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip());
        });

        RateLimiter::for('newsletter', function (Request $request) {
            return Limit::perMinute(3)->by($request->ip());
        });

        RateLimiter::for('contact', function (Request $request) {
            return Limit::perMinute(3)->by($request->ip());
        });

        RateLimiter::for('webhooks', function (Request $request) {
            return Limit::perMinute(100)->by($request->ip());
        });
    }
}
