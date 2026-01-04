<?php

namespace App\Http\Controllers;

use App\Models\PrayerRequest;
use Illuminate\Http\Request;

class PrayerRequestController extends Controller
{
    public function index()
    {
        return view('public.prayer');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'request' => 'required|string|max:1000',
            'is_anonymous' => 'boolean',
        ]);

        PrayerRequest::create($request->all());

        return back()->with('success', 'Your prayer request has been submitted. We will pray for you.');
    }

    // Admin methods
    public function adminIndex()
    {
        $prayerRequests = PrayerRequest::latest()->paginate(20);
        return view('admin.prayer_requests.index', compact('prayerRequests'));
    }
}
