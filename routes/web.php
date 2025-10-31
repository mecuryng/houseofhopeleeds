<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SermonController;

// Ensure the 'role' alias is registered with the router so middleware like
// `role:admin` resolves correctly at runtime.
Route::aliasMiddleware('role', RoleMiddleware::class);

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/pastor', [AdminController::class, 'pastor'])
        ->middleware('role:pastor')
        ->name('pastor.dashboard');



Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('members', MemberController::class);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('events', EventController::class);
    Route::resource('sermons', SermonController::class);
});

Route::get('/', function () {
    return view('welcome'); // We’ll use the default view for now
});

});

require __DIR__.'/auth.php';
