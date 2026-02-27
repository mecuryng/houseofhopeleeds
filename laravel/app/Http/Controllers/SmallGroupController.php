<?php

namespace App\Http\Controllers;

use App\Models\SmallGroup;
use Illuminate\Http\Request;

class SmallGroupController extends Controller
{
    public function index()
    {
        $groups = SmallGroup::with('leader')
            ->withCount('members')
            ->open()
            ->paginate(12);

        return view('public.groups.index', compact('groups'));
    }

    public function show(SmallGroup $group)
    {
        $group->load(['leader', 'members']);

        return view('public.groups.show', compact('group'));
    }

    public function join(Request $request, SmallGroup $group)
    {
        if (!$group->is_open) {
            return back()->with('error', 'This group is not open for new members.');
        }

        if ($group->members()->count() >= $group->max_members) {
            return back()->with('error', 'This group is full.');
        }

        if ($group->hasMember($request->user()->id)) {
            return back()->with('error', 'You are already a member of this group.');
        }

        $group->members()->attach($request->user()->id, [
            'role' => 'member',
            'joined_at' => now(),
        ]);

        return back()->with('success', 'You have joined the group!');
    }

    public function leave(Request $request, SmallGroup $group)
    {
        $group->members()->detach($request->user()->id);

        return back()->with('success', 'You have left the group.');
    }
}
