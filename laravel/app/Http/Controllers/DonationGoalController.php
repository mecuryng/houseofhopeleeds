<?php

namespace App\Http\Controllers;

use App\Models\DonationGoal;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonationGoalController extends Controller
{
    public function index()
    {
        $goals = DonationGoal::active()
            ->current()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('public.goals.index', compact('goals'));
    }

    public function adminIndex()
    {
        $goals = DonationGoal::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.goals.index', compact('goals'));
    }

    public function create()
    {
        return view('admin.goals.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_amount' => 'required|numeric|min:1',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_active' => 'boolean',
            'show_progress' => 'boolean',
            'color' => 'nullable|string|max:50',
        ]);

        $validated['current_amount'] = 0;

        DonationGoal::create($validated);

        return redirect()->route('admin.goals.index')
            ->with('success', 'Donation goal created successfully.');
    }

    public function edit(DonationGoal $goal)
    {
        return view('admin.goals.edit', compact('goal'));
    }

    public function update(Request $request, DonationGoal $goal)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_amount' => 'required|numeric|min:1',
            'current_amount' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_active' => 'boolean',
            'show_progress' => 'boolean',
            'color' => 'nullable|string|max:50',
        ]);

        $goal->update($validated);

        return redirect()->route('admin.goals.index')
            ->with('success', 'Donation goal updated successfully.');
    }

    public function destroy(DonationGoal $goal)
    {
        $goal->delete();

        return redirect()->route('admin.goals.index')
            ->with('success', 'Donation goal deleted successfully.');
    }
}
