<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SermonController;
use App\Http\Controllers\RsvpController;
use App\Http\Controllers\SermonInteractionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PrayerRequestController;
use App\Models\Event;
use App\Models\Sermon;

// Public (no-auth) routes
Route::get('/', function () {
    $events = Event::where('date', '>=', now())->orderBy('date')->take(3)->get();
    $sermons = Sermon::latest()->take(3)->get();
    return view('public.home', compact('events', 'sermons'));
})->name('home');

Route::view('/about', 'public.about')->name('about');
Route::view('/ministries', 'public.ministries')->name('ministries');
Route::view('/contact', 'public.contact')->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::get('/events', function () {
    $events = Event::orderBy('date')->get();
    return view('public.events', compact('events'));
})->name('events');

// Single event interactive page
Route::get('/events/{event}', function (Event $event) {
    return view('public.event', compact('event'));
})->name('events.show');

// RSVP submission for an event
Route::post('/events/{event}/rsvp', [RsvpController::class, 'store'])->name('events.rsvp');

Route::get('/sermons', function () {
    $sermons = Sermon::with('pastor')->orderBy('date', 'desc')->get();
    return view('public.sermons', compact('sermons'));
})->name('sermons');

// Single sermon interactive page (audio/video)
Route::get('/sermons/{sermon}', function (Sermon $sermon) {
    return view('public.sermon', compact('sermon'));
})->name('sermons.show');

// Sermon interactions: comments and likes
Route::post('/sermons/{sermon}/comments', [SermonInteractionController::class, 'storeComment'])->name('sermons.comments.store');
Route::post('/sermons/{sermon}/like', [SermonInteractionController::class, 'toggleLike'])->name('sermons.like.toggle');

Route::get('/staff', function () {
    $staff = \App\Models\User::where('role', '!=', 'member')->orderBy('name')->get();
    return view('public.staff', compact('staff'));
})->name('staff');

Route::get('/prayer', [PrayerRequestController::class, 'index'])->name('prayer');
Route::post('/prayer', [PrayerRequestController::class, 'store'])->name('prayer.store');

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
    // Admin RSVP list
    Route::get('rsvps', [RsvpController::class, 'index'])->name('rsvps.index');
    Route::delete('rsvps/{rsvp}', [RsvpController::class, 'destroy'])->name('rsvps.destroy');
    Route::get('rsvps/export', [RsvpController::class, 'export'])->name('rsvps.export');
    Route::get('rsvps/{rsvp}', [RsvpController::class, 'show'])->name('rsvps.show');
    
    // Admin: Sermon comments moderation
    Route::get('sermon-comments', [App\Http\Controllers\SermonInteractionController::class, 'indexComments'])->name('sermon-comments.index');
    Route::post('sermon-comments/{comment}/approve', [App\Http\Controllers\SermonInteractionController::class, 'approve'])->name('sermon-comments.approve');
    Route::delete('sermon-comments/{comment}', [App\Http\Controllers\SermonInteractionController::class, 'destroyComment'])->name('sermon-comments.destroy');

    // Admin: Prayer requests
    Route::get('prayer-requests', [PrayerRequestController::class, 'adminIndex'])->name('prayer-requests.index');
});

require __DIR__.'/auth.php';
