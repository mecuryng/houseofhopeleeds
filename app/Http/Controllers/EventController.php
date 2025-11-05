<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $events = Event::orderBy('date', 'desc')->paginate(10);
    return view('admin.events.index', compact('events'));
}

public function create()
{
    return view('admin.events.create');
}

public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|max:255',
        'event_date' => 'required|date',
        'venue' => 'nullable|string|max:255',
        'description' => 'nullable|string'
    ]);

    $data = $validated;
    $data['date'] = $validated['event_date'];
    unset($data['event_date']);
    if (isset($validated['venue'])) {
        $data['location'] = $validated['venue'];
        unset($data['venue']);
    }

    Event::create($data);
    return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
}

public function edit(Event $event)
{
    return view('admin.events.edit', compact('event'));
}

public function update(Request $request, Event $event)
{
    $validated = $request->validate([
        'title' => 'required|max:255',
        'event_date' => 'required|date',
        'venue' => 'nullable|string|max:255',
        'description' => 'nullable|string'
    ]);

    $data = $validated;
    $data['date'] = $validated['event_date'];
    unset($data['event_date']);
    if (isset($validated['venue'])) {
        $data['location'] = $validated['venue'];
        unset($data['venue']);
    }

    $event->update($data);
    return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
}

public function destroy(Event $event)
{
    $event->delete();
    return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
}


    
}
