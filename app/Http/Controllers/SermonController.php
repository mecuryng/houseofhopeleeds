<?php

namespace App\Http\Controllers;

use App\Models\Sermon;
use Illuminate\Http\Request;
use App\Models\User;

class SermonController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function index(Request $request)
{
    $query = Sermon::with('pastor');

    if ($request->filled('pastor_filter')) {
        $query->where('pastor_id', $request->pastor_filter);
    }

    $sermons = $query->latest()->paginate(10)->withQueryString();
    return view('admin.sermons.index', compact('sermons'));
}

public function create(Request $request)
{
    $pastors = User::where('role', 'pastor')->get();
    $selectedPastorId = $request->query('pastor_id');
    return view('admin.sermons.create', compact('pastors', 'selectedPastorId'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'nullable|string',
        'date_preached' => 'required|date',
        'pastor_id' => 'nullable|exists:users,id',
        'video_url' => 'nullable|url'
    ]);

    $data = $validated;
    $data['date'] = $validated['date_preached'];
    unset($data['date_preached']);
    if (isset($validated['content'])) {
        $data['description'] = $validated['content'];
        unset($data['content']);
    }

    Sermon::create($data);
    return redirect()->route('admin.sermons.index')->with('success', 'Sermon added successfully.');
}

public function edit(Sermon $sermon)
{
    $pastors = User::where('role', 'pastor')->get();
    return view('admin.sermons.edit', compact('sermon', 'pastors'));
}

public function update(Request $request, Sermon $sermon)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'nullable|string',
        'date_preached' => 'required|date',
        'pastor_id' => 'nullable|exists:users,id',
        'video_url' => 'nullable|url'
    ]);

    $data = $validated;
    $data['date'] = $validated['date_preached'];
    unset($data['date_preached']);
    if (isset($validated['content'])) {
        $data['description'] = $validated['content'];
        unset($data['content']);
    }

    $sermon->update($data);
    return redirect()->route('admin.sermons.index')->with('success', 'Sermon updated successfully.');
}

public function destroy(Sermon $sermon)
{
    $sermon->delete();
    return redirect()->route('admin.sermons.index')->with('success', 'Sermon deleted successfully.');
}

}
