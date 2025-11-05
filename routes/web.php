<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SermonController;
use App\Models\Event;
use App\Models\Sermon;

// Public (no-auth) routes
Route::get('/', function () {
    $events = Event::where('date', '>=', now())->orderBy('date')->take(3)->get();
    $sermons = Sermon::latest()->take(3)->get();
    return view('public.home', compact('events', 'sermons'));
})->name('home');

Route::view('/about', 'public.about')->name('about');
Route::get('/events', function () {
    $events = Event::orderBy('date')->get();
    return view('public.events', compact('events'));
})->name('events');

Route::get('/sermons', function () {
    $sermons = Sermon::with('pastor')->orderBy('date', 'desc')->get();
    return view('public.sermons', compact('sermons'));
})->name('sermons');

Route::view('/donate', 'public.donate')->name('donate');

// Auth-only routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('profile', 'profile')->name('profile');
});

// Admin-only routes (under /admin prefix, named admin.*)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/pastor', [AdminController::class, 'pastor'])->middleware('role:pastor')->name('pastor');

    Route::resource('members', MemberController::class);
    // Admin event/sermon resources will be available at /admin/events and /admin/sermons
    Route::resource('events', EventController::class);
    Route::resource('sermons', SermonController::class);
});

require __DIR__.'/auth.php';
