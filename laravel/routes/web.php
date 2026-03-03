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
use App\Http\Controllers\ReflectionInteractionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PastorController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\SermonSeriesController;
use App\Http\Controllers\SmallGroupController;
use App\Http\Controllers\DonationGoalController;
use App\Models\Event;
use App\Models\Sermon;
use App\Models\SermonSeries;
use App\Models\SmallGroup;
use App\Models\DonationGoal;
use App\Services\BibleVerseService;

// Public (no-auth) routes
Route::get('/', function () {
    $events = Event::where('date', '>=', now())->orderBy('date')->take(3)->get();
    $sermons = Sermon::latest()->take(3)->get();
    return view('public.home', compact('events', 'sermons'));
})->name('home');

Route::view('/about', 'public.about')->name('about');
Route::view('/ministries', 'public.ministries')->name('ministries');
Route::view('/contact', 'public.contact')->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->middleware('throttle:contact')->name('contact.send');
Route::get('/events', function (Illuminate\Http\Request $request) {
    $query = Event::orderBy('date');
    
    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('location', 'like', "%{$search}%");
        });
    }
    
    $events = $query->paginate(9)->withQueryString();
    return view('public.events', compact('events'));
})->name('events');

// Single event interactive page
Route::get('/events/{event}', function (Event $event) {
    return view('public.event', compact('event'));
})->name('events.show');

// RSVP submission for an event
Route::post('/events/{event}/rsvp', [RsvpController::class, 'store'])->name('events.rsvp');

Route::get('/sermons', function (Illuminate\Http\Request $request) {
    $query = Sermon::with('pastor')->orderBy('date', 'desc');
    
    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }
    
    $sermons = $query->paginate(9)->withQueryString();
    return view('public.sermons', compact('sermons'));
})->name('sermons');

// Sermon Series routes - must come before /sermons/{sermon}
Route::get('/sermons/series', function () {
    $series = SermonSeries::withCount('sermons')->active()->ordered()->paginate(12);
    return view('public.series.index', compact('series'));
})->name('series.index');

Route::get('/sermons/series/{series}', function (SermonSeries $series) {
    $series->load(['sermons.pastor']);
    return view('public.series.show', compact('series'));
})->name('series.show');

// Single sermon interactive page (audio/video)
Route::get('/sermons/{sermon}', function (Sermon $sermon) {
    return view('public.sermon', compact('sermon'));
})->name('sermons.show');

// Sermon interactions: comments and likes
Route::post('/sermons/{sermon}/comments', [SermonInteractionController::class, 'storeComment'])->name('sermons.comments.store');
Route::post('/sermons/{sermon}/like', [SermonInteractionController::class, 'toggleLike'])->name('sermons.like.toggle');

// Reflection interactions: comments and likes (similar pattern to sermons)
Route::post('/reflections/{reflection}/comments', [ReflectionInteractionController::class, 'storeComment'])->name('reflections.comments.store');
Route::post('/reflections/{reflection}/like', [ReflectionInteractionController::class, 'toggleLike'])->name('reflections.like.toggle');

Route::get('/staff', function () {
    $staff = \App\Models\User::where('role', '!=', 'member')->orderBy('name')->get();
    return view('public.staff', compact('staff'));
})->name('staff');

Route::get('/prayer', [PrayerRequestController::class, 'index'])->name('prayer');
Route::post('/prayer', [PrayerRequestController::class, 'store'])->middleware('throttle:contact')->name('prayer.store');

Route::get('/donate', function () {
    $goals = \App\Models\DonationGoal::active()
        ->where('show_progress', true)
        ->current()
        ->orderBy('created_at', 'desc')
        ->get();
    return view('public.donate', compact('goals'));
})->name('donate');

// Payment endpoints: create provider sessions and webhooks
Route::post('/donate/stripe/create', [DonationController::class, 'createStripeSession'])->middleware('throttle:donations')->name('donate.stripe.create');
Route::post('/webhooks/stripe', [DonationController::class, 'stripeWebhook'])->middleware('throttle:webhooks')->name('webhooks.stripe');
Route::post('/donate/paypal/create', [DonationController::class, 'createPaypalOrder'])->middleware('throttle:donations')->name('donate.paypal.create');
Route::post('/webhooks/paypal', [DonationController::class, 'paypalWebhook'])->middleware('throttle:webhooks')->name('webhooks.paypal');
Route::get('/donate/success', [DonationController::class, 'success'])->name('donate.success');
Route::get('/donate/cancel', [DonationController::class, 'cancel'])->name('donate.cancel');

// Newsletter subscription
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->middleware('throttle:newsletter')->name('newsletter.subscribe');
Route::post('/newsletter/unsubscribe', [NewsletterController::class, 'unsubscribe'])->middleware('throttle:newsletter')->name('newsletter.unsubscribe');
Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'confirmUnsubscribe'])->name('newsletter.unsubscribe.confirm');

// Feeds
Route::get('/events.ical', [FeedController::class, 'eventsIcal'])->name('events.ical');
Route::get('/sermons.rss', [FeedController::class, 'sermonsRss'])->name('sermons.rss');

// Bible verse auto-linking (AJAX)
Route::post('/bible/link', function (Illuminate\Http\Request $request) {
    $request->validate(['text' => 'required|string']);
    $service = app(BibleVerseService::class);
    return response()->json([
        'original' => $request->text,
        'linked' => $service->autoLink($request->text),
    ]);
})->name('bible.link');

// Small Groups
Route::get('/groups', [SmallGroupController::class, 'index'])->name('groups.index');
Route::get('/groups/{group}', [SmallGroupController::class, 'show'])->name('groups.show');
Route::post('/groups/{group}/join', [SmallGroupController::class, 'join'])->middleware('auth')->name('groups.join');
Route::post('/groups/{group}/leave', [SmallGroupController::class, 'leave'])->middleware('auth')->name('groups.leave');

// Donation Goals (public progress bars)
Route::get('/goals', [DonationGoalController::class, 'index'])->name('goals.index');

// Revelations & Visions public listing (still backed by Dream model)
Route::get('/dreams', function () {
    $dreams = \App\Models\Dream::latest()->paginate(10);
    return view('public.dreams', compact('dreams'));
})->name('dreams.index');

Route::get('/dreams/{dream}', function (\App\Models\Dream $dream) {
    return view('public.dream', compact('dream'));
})->name('dreams.show');

// Reflections public routes
Route::get('/reflections', function () {
    $reflections = \App\Models\Reflection::latest()->paginate(10);
    return view('public.reflections', compact('reflections')); 
})->name('reflections.index');

Route::get('/reflections/{reflection}', function (\App\Models\Reflection $reflection) {
    return view('public.reflection', compact('reflection'));
})->name('reflections.show');

// Member directory (auth required)
Route::get('/directory', function () {
    $members = \App\Models\User::where('role', 'member')
        ->where('is_directory_visible', true)
        ->orderBy('name')
        ->paginate(20);
    return view('public.directory', compact('members'));
})->middleware(['auth', 'verified'])->name('directory');

// Auth-only routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('profile', 'profile')->name('profile');
});

// Pastor-only routes
Route::middleware(['auth', 'role:pastor'])->group(function () {
    Route::get('/pastor', [PastorController::class, 'dashboard'])->name('pastor');

    // Sermon management for pastors
    Route::prefix('pastor')->name('pastor.')->group(function() {
        Route::resource('sermons', PastorController::class)->parameters([
            'sermons' => 'sermon'
        ]);
        // pastors can manage dreams as well
        Route::resource('dreams', \App\Http\Controllers\DreamController::class);
            Route::resource('reflections', \App\Http\Controllers\ReflectionController::class);
    });
});

// Admin-only routes (under /admin prefix, named admin.*)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    Route::resource('members', MemberController::class);
    Route::resource('users', UserController::class);
    // Admin event/sermon resources will be available at /admin/events and /admin/sermons
    Route::resource('events', EventController::class);
    Route::resource('sermons', SermonController::class);
    Route::resource('dreams', \App\Http\Controllers\DreamController::class);
    Route::resource('reflections', \App\Http\Controllers\ReflectionController::class);
    // Admin donations
    Route::get('donations', [App\Http\Controllers\Admin\DonationController::class, 'index'])->name('donations.index');
    Route::get('donations/{donation}', [App\Http\Controllers\Admin\DonationController::class, 'show'])->name('donations.show');
    Route::delete('donations/{donation}', [App\Http\Controllers\Admin\DonationController::class, 'destroy'])->name('donations.destroy');
    Route::get('donations/export', [App\Http\Controllers\Admin\DonationController::class, 'export'])->name('donations.export');
    // Admin RSVP list
    Route::get('rsvps', [RsvpController::class, 'index'])->name('rsvps.index');
    Route::delete('rsvps/{rsvp}', [RsvpController::class, 'destroy'])->name('rsvps.destroy');
    Route::get('rsvps/export', [RsvpController::class, 'export'])->name('rsvps.export');
    Route::get('rsvps/{rsvp}', [RsvpController::class, 'show'])->name('rsvps.show');
    
    // Admin: Sermon comments moderation
    Route::get('sermon-comments', [App\Http\Controllers\SermonInteractionController::class, 'indexComments'])->name('sermon-comments.index');
    Route::post('sermon-comments/{comment}/approve', [App\Http\Controllers\SermonInteractionController::class, 'approve'])->name('sermon-comments.approve');
    Route::delete('sermon-comments/{comment}', [App\Http\Controllers\SermonInteractionController::class, 'destroyComment'])->name('sermon-comments.destroy');

    // Reflection comments moderation
    Route::get('reflection-comments', [App\Http\Controllers\ReflectionInteractionController::class, 'indexComments'])->name('reflection-comments.index');
    Route::post('reflection-comments/{comment}/approve', [App\Http\Controllers\ReflectionInteractionController::class, 'approve'])->name('reflection-comments.approve');
    Route::delete('reflection-comments/{comment}', [App\Http\Controllers\ReflectionInteractionController::class, 'destroyComment'])->name('reflection-comments.destroy');

    // Admin: Prayer requests
    Route::get('prayer-requests', [PrayerRequestController::class, 'adminIndex'])->name('prayer-requests.index');
    Route::get('prayer-requests/export-csv', [PrayerRequestController::class, 'exportCsv'])->name('prayer-requests.export-csv');
    Route::get('prayer-requests/export-pdf', [PrayerRequestController::class, 'exportPdf'])->name('prayer-requests.export-pdf');

    // Admin: Newsletter subscribers
    Route::get('newsletter', [NewsletterController::class, 'adminIndex'])->name('newsletter.index');
    Route::get('newsletter/export', [NewsletterController::class, 'export'])->name('newsletter.export');
    Route::delete('newsletter/{subscriber}', [NewsletterController::class, 'destroy'])->name('newsletter.destroy');

    // Admin: Sermon Series
    Route::resource('series', SermonSeriesController::class);

    // Admin: Small Groups
    Route::resource('groups', \App\Http\Controllers\Admin\SmallGroupController::class);
    Route::delete('groups/{group}/members/{member}', [\App\Http\Controllers\Admin\SmallGroupController::class, 'removeMember'])->name('groups.members.remove');

    // Admin: Donation Goals
    Route::resource('goals', DonationGoalController::class);
    
    // Admin: Analytics dashboard
    Route::get('analytics', [AdminController::class, 'analytics'])->name('analytics');
});

require __DIR__.'/auth.php';
