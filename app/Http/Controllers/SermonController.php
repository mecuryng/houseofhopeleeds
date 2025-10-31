<?php

namespace App\Http\Controllers;

use App\Models\Sermon;
use Illuminate\Http\Request;

class SermonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   use App\Models\User;

public function index()
{
    $sermons = Sermon::with('pastor')->latest()->paginate(10);
    return view('admin.sermons.index', compact('sermons'));
}

public function create()
{
    $pastors = User::where('role', 'pastor')->get();
    return view('admin.sermons.create', compact('pastors'));
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'nullable|string',
        'date_preached' => 'required|date',
        'pastor_id' => 'nullable|exists:users,id'
    ]);

    Sermon::create($request->all());
    return redirect()->route('sermons.index')->with('success', 'Sermon added successfully.');
}

public function edit(Sermon $sermon)
{
    $pastors = User::where('role', 'pastor')->get();
    return view('admin.sermons.edit', compact('sermon', 'pastors'));
}

public function update(Request $request, Sermon $sermon)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'nullable|string',
        'date_preached' => 'required|date',
        'pastor_id' => 'nullable|exists:users,id'
    ]);

    $sermon->update($request->all());
    return redirect()->route('sermons.index')->with('success', 'Sermon updated successfully.');
}

public function destroy(Sermon $sermon)
{
    $sermon->delete();
    return redirect()->route('sermons.index')->with('success', 'Sermon deleted successfully.');
}

}
