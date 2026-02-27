<?php

namespace App\Http\Controllers;

use App\Models\SermonSeries;
use App\Models\Sermon;
use Illuminate\Http\Request;

class SermonSeriesController extends Controller
{
    public function index()
    {
        $series = SermonSeries::with('sermons')
            ->active()
            ->ordered()
            ->paginate(12);

        return view('public.series.index', compact('series'));
    }

    public function show(SermonSeries $series)
    {
        $series->load(['sermons.pastor']);

        return view('public.series.show', compact('series'));
    }

    public function adminIndex(Request $request)
    {
        $query = SermonSeries::withCount('sermons')->ordered();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%");
        }

        $series = $query->paginate(20);

        return view('admin.series.index', compact('series'));
    }

    public function create()
    {
        return view('admin.series.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:sermon_series,slug',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url|max:500',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $series = SermonSeries::create($validated);

        return redirect()->route('admin.series.index')
            ->with('success', 'Series created successfully.');
    }

    public function edit(SermonSeries $series)
    {
        return view('admin.series.edit', compact('series'));
    }

    public function update(Request $request, SermonSeries $series)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:sermon_series,slug,' . $series->id,
            'description' => 'nullable|string',
            'image_url' => 'nullable|url|max:500',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $series->update($validated);

        return redirect()->route('admin.series.index')
            ->with('success', 'Series updated successfully.');
    }

    public function destroy(SermonSeries $series)
    {
        $series->sermons()->update(['series_id' => null, 'series_order' => null]);
        $series->delete();

        return redirect()->route('admin.series.index')
            ->with('success', 'Series deleted successfully.');
    }
}
