<?php

namespace App\Http\Controllers;

use App\Models\Sermon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

class PastorController extends Controller
{
    public function dashboard()
    {
        return view('pastor.dashboard');
    }

    // Sermon management for pastors - only their own sermons
    public function index()
    {
        $sermons = auth()->user()->sermons()->with(['comments', 'likes'])->latest()->paginate(20);
        return view('pastor.sermons.index', compact('sermons'));
    }

    public function create()
    {
        return view('pastor.sermons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'date_preached' => 'required|date',
            'video_url' => 'nullable|url'
        ]);

        $data = $request->only(['title', 'content', 'date_preached', 'video_url']);
        $data['date'] = $request->date_preached;
        $data['pastor_id'] = auth()->id();

        if (isset($request->content)) {
            $data['description'] = $request->content;
            unset($data['content']);
        }

        Sermon::create($data);

        return redirect()->route('pastor.sermons.index')->with('success', 'Sermon created successfully.');
    }

    public function show(Sermon $sermon)
    {
        // Ensure pastor can only view their own sermons
        if ($sermon->pastor_id !== auth()->id()) {
            abort(403, 'You can only view your own sermons.');
        }

        return view('pastor.sermons.show', compact('sermon'));
    }

    public function edit(Sermon $sermon)
    {
        // Ensure pastor can only edit their own sermons
        if ($sermon->pastor_id !== auth()->id()) {
            abort(403, 'You can only edit your own sermons.');
        }

        return view('pastor.sermons.edit', compact('sermon'));
    }

    public function update(Request $request, Sermon $sermon)
    {
        // Ensure pastor can only update their own sermons
        if ($sermon->pastor_id !== auth()->id()) {
            abort(403, 'You can only edit your own sermons.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'date_preached' => 'required|date',
            'video_url' => 'nullable|url'
        ]);

        $data = $request->only(['title', 'content', 'date_preached', 'video_url']);
        $data['date'] = $request->date_preached;

        if (isset($request->content)) {
            $data['description'] = $request->content;
            unset($data['content']);
        }

        $sermon->update($data);

        return redirect()->route('pastor.sermons.index')->with('success', 'Sermon updated successfully.');
    }

    public function destroy(Sermon $sermon)
    {
        // Ensure pastor can only delete their own sermons
        if ($sermon->pastor_id !== auth()->id()) {
            abort(403, 'You can only delete your own sermons.');
        }

        $sermon->delete();

        return redirect()->route('pastor.sermons.index')->with('success', 'Sermon deleted successfully.');
    }
}
