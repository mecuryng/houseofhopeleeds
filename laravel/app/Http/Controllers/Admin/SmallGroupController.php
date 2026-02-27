<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SmallGroup;
use App\Models\User;
use Illuminate\Http\Request;

class SmallGroupController extends Controller
{
    public function index()
    {
        $groups = SmallGroup::with('leader')
            ->withCount('members')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.groups.index', compact('groups'));
    }

    public function create()
    {
        $leaders = User::whereIn('role', ['pastor', 'admin'])
            ->orderBy('name')
            ->get();

        return view('admin.groups.create', compact('leaders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'leader_id' => 'nullable|exists:users,id',
            'location' => 'nullable|string|max:255',
            'meeting_day' => 'nullable|string|max:50',
            'meeting_time' => 'nullable|string|max:10',
            'max_members' => 'nullable|integer|min:1',
            'is_open' => 'boolean',
            'category' => 'nullable|string|max:100',
        ]);

        SmallGroup::create($validated);

        return redirect()->route('admin.groups.index')
            ->with('success', 'Small group created successfully.');
    }

    public function show(SmallGroup $group)
    {
        $group->load(['leader', 'members']);

        return view('admin.groups.show', compact('group'));
    }

    public function edit(SmallGroup $group)
    {
        $leaders = User::whereIn('role', ['pastor', 'admin'])
            ->orderBy('name')
            ->get();

        return view('admin.groups.edit', compact('group', 'leaders'));
    }

    public function update(Request $request, SmallGroup $group)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'leader_id' => 'nullable|exists:users,id',
            'location' => 'nullable|string|max:255',
            'meeting_day' => 'nullable|string|max:50',
            'meeting_time' => 'nullable|string|max:10',
            'max_members' => 'nullable|integer|min:1',
            'is_open' => 'boolean',
            'category' => 'nullable|string|max:100',
        ]);

        $group->update($validated);

        return redirect()->route('admin.groups.index')
            ->with('success', 'Small group updated successfully.');
    }

    public function destroy(SmallGroup $group)
    {
        $group->members()->detach();
        $group->delete();

        return redirect()->route('admin.groups.index')
            ->with('success', 'Small group deleted successfully.');
    }

    public function removeMember(SmallGroup $group, User $member)
    {
        $group->members()->detach($member->id);

        return back()->with('success', 'Member removed from group.');
    }
}
