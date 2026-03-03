<?php

namespace App\Http\Controllers;

use App\Models\Sermon;
use App\Models\SermonSeries;
use Illuminate\Http\Request;
use App\Models\User;

class SermonController extends Controller
{
    public function index(Request $request)
    {
        $query = Sermon::with('pastor', 'series');

        if ($request->filled('pastor_filter')) {
            $query->where('pastor_id', $request->pastor_filter);
        }

        $sermons = $query->latest()->paginate(10)->withQueryString();
        return view('admin.sermons.index', compact('sermons'));
    }

    public function create(Request $request)
    {
        $pastors = User::where('role', 'pastor')->get();
        $series = SermonSeries::orderBy('name')->get();
        $selectedPastorId = $request->query('pastor_id');
        return view('admin.sermons.create', compact('pastors', 'series', 'selectedPastorId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'date_preached' => 'required|date',
            'pastor_id' => 'nullable|exists:users,id',
            'video_url' => 'nullable|url',
            'audio_url' => 'nullable|url',
            'bible_passage' => 'nullable|string|max:255',
            'series_id' => 'nullable|exists:sermon_series,id',
            'series_order' => 'nullable|integer|min:1',
            'duration' => 'nullable|string|max:20',
            'thumbnail' => 'nullable|url|max:500',
            'chapters' => 'nullable|json',
            'image' => 'nullable|image|max:10240',
        ]);

        $data = $validated;
        $data['date'] = $validated['date_preached'];
        unset($data['date_preached']);
        if (isset($validated['content'])) {
            $data['description'] = $validated['content'];
            unset($data['content']);
        }
        if (isset($validated['chapters'])) {
            $data['chapters'] = json_decode($validated['chapters'], true);
        }

        // handle uploaded image (admin may choose to attach)
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('sermons', 'public');
        }

        Sermon::create($data);
        return redirect()->route('admin.sermons.index')->with('success', 'Sermon added successfully.');
    }

    public function edit(Sermon $sermon)
    {
        $pastors = User::where('role', 'pastor')->get();
        $series = SermonSeries::orderBy('name')->get();
        return view('admin.sermons.edit', compact('sermon', 'pastors', 'series'));
    }

    public function update(Request $request, Sermon $sermon)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'date_preached' => 'required|date',
            'pastor_id' => 'nullable|exists:users,id',
            'video_url' => 'nullable|url',
            'audio_url' => 'nullable|url',
            'bible_passage' => 'nullable|string|max:255',
            'series_id' => 'nullable|exists:sermon_series,id',
            'series_order' => 'nullable|integer|min:1',
            'duration' => 'nullable|string|max:20',
            'thumbnail' => 'nullable|url|max:500',
            'chapters' => 'nullable|json',
            'image' => 'nullable|image|max:10240',
            'remove_image' => 'nullable|boolean',
        ]);

        $data = $validated;
        $data['date'] = $validated['date_preached'];
        unset($data['date_preached']);
        if (isset($validated['content'])) {
            $data['description'] = $validated['content'];
            unset($data['content']);
        }
        if (isset($validated['chapters'])) {
            $data['chapters'] = json_decode($validated['chapters'], true);
        }

        // remove remove_image from data array since it's not a column
        unset($data['remove_image']);

        // handle image removal
        if ($request->input('remove_image')) {
            if ($sermon->image_path) {
                \Storage::disk('public')->delete($sermon->image_path);
            }
            $data['image_path'] = null;
        } elseif ($request->hasFile('image')) {
            // remove previous image if there was one
            if ($sermon->image_path) {
                \Storage::disk('public')->delete($sermon->image_path);
            }
            $data['image_path'] = $request->file('image')->store('sermons', 'public');
        }

        $sermon->update($data);
        return redirect()->route('admin.sermons.index')->with('success', 'Sermon updated successfully.');
    }

    public function destroy(Sermon $sermon)
    {
        // delete attached image if it exists
        if ($sermon->image_path) {
            \Storage::disk('public')->delete($sermon->image_path);
        }
        $sermon->delete();
        return redirect()->route('admin.sermons.index')->with('success', 'Sermon deleted successfully.');
    }
}
