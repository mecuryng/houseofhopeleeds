<?php

namespace App\Http\Controllers;

use App\Models\Reflection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReflectionController extends Controller
{
    /**
     * Display a listing of reflections for admin/pastor.
     */
    public function index()
    {
        $reflections = Reflection::with('user')->latest()->paginate(20);
        return view('admin.reflections.index', compact('reflections'));
    }

    /**
     * Show form to create new reflection.
     */
    public function create()
    {
        return view('admin.reflections.create');
    }

    /**
     * Store new reflection.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'date' => 'nullable|date',
            'image' => 'nullable|image|max:10240',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('reflections', 'public');
        }

        $reflection = new Reflection($validated);
        $reflection->user_id = Auth::id();
        $reflection->save();

        return redirect()->route('admin.reflections.index')->with('success', 'Reflection added successfully.');
    }

    /**
     * Show form to edit reflection.
     */
    public function edit(Reflection $reflection)
    {
        return view('admin.reflections.edit', compact('reflection'));
    }

    /**
     * Update existing reflection.
     */
    public function update(Request $request, Reflection $reflection)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'date' => 'nullable|date',
            'image' => 'nullable|image|max:10240',
        ]);

        if ($request->hasFile('image')) {
            if ($reflection->image_path) {
                \Storage::disk('public')->delete($reflection->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('reflections', 'public');
        }

        $reflection->update($validated);
        return redirect()->route('admin.reflections.index')->with('success', 'Reflection updated successfully.');
    }

    /**
     * Remove reflection.
     */
    public function destroy(Reflection $reflection)
    {
        if ($reflection->image_path) {
            \Storage::disk('public')->delete($reflection->image_path);
        }
        $reflection->delete();
        return redirect()->route('admin.reflections.index')->with('success', 'Reflection deleted successfully.');
    }
}
