<?php

namespace App\Http\Controllers;

use App\Models\Dream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DreamController extends Controller
{
    /**
     * Display a listing of the dreams (admin/pastor view).
     */
    public function index()
    {
        $dreams = Dream::latest()->paginate(20);
        return view('admin.dreams.index', compact('dreams'));
    }

    /**
     * Show the form for creating a new dream.
     */
    public function create()
    {
        return view('admin.dreams.create');
    }

    /**
     * Store a newly created dream in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf|max:10240',
        ]);

        // handle file upload if provided
        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('revelations', 'public');
            $validated['attachment_path'] = $path;
        }

        $dream = new Dream($validated);
        $dream->user_id = Auth::id();
        $dream->save();

        return redirect()->route('admin.dreams.index')->with('success', 'Dream or vision post created.');
    }

    /**
     * Show the form for editing the specified dream.
     */
    public function edit(Dream $dream)
    {
        return view('admin.dreams.edit', compact('dream'));
    }

    /**
     * Update the specified dream in storage.
     */
    public function update(Request $request, Dream $dream)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf|max:10240',
        ]);

        if ($request->hasFile('attachment')) {
            // delete old file if exists
            if ($dream->attachment_path) {
                \Storage::disk('public')->delete($dream->attachment_path);
            }
            $path = $request->file('attachment')->store('revelations', 'public');
            $validated['attachment_path'] = $path;
        }

        $dream->update($validated);

        return redirect()->route('admin.dreams.index')->with('success', 'Dream or vision post updated.');
    }

    /**
     * Remove the specified dream from storage.
     */
    public function destroy(Dream $dream)
    {
        $dream->delete();
        return redirect()->route('admin.dreams.index')->with('success', 'Dream or vision post deleted.');
    }
}
