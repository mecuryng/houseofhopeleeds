<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reflection;
use App\Models\ReflectionComment;
use App\Models\ReflectionLike;

class ReflectionInteractionController extends Controller
{
    public function storeComment(Request $request, Reflection $reflection)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'content' => 'required|string|max:2000',
        ]);

        $data['user_id'] = auth()->id();
        $data['reflection_id'] = $reflection->id;

        ReflectionComment::create($data);

        return redirect()->back()->with('comment_success', 'Thank you — your comment was posted.');
    }

    public function toggleLike(Request $request, Reflection $reflection)
    {
        $userId = auth()->id();
        $sessionId = $request->session()->getId();

        $like = ReflectionLike::where('reflection_id', $reflection->id)
            ->when($userId, fn($q) => $q->where('user_id', $userId), fn($q) => $q->where('session_id', $sessionId))
            ->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            ReflectionLike::create([
                'reflection_id' => $reflection->id,
                'user_id' => $userId,
                'session_id' => $sessionId,
                'ip' => $request->ip(),
            ]);
            $liked = true;
        }

        $count = ReflectionLike::where('reflection_id', $reflection->id)->count();

        return response()->json(['liked' => $liked, 'count' => $count]);
    }

    public function indexComments(Request $request)
    {
        $query = ReflectionComment::with('reflection')->latest();

        if ($q = $request->query('q')) {
            $query->where(function ($qb) use ($q) {
                $qb->where('name', 'like', "%{$q}%")
                   ->orWhere('email', 'like', "%{$q}%")
                   ->orWhere('content', 'like', "%{$q}%");
            });
        }

        if ($refId = $request->query('reflection_id')) {
            $query->where('reflection_id', $refId);
        }

        $comments = $query->paginate(20)->withQueryString();
        return view('admin.reflection_comments.index', compact('comments'));
    }

    public function approve(ReflectionComment $comment)
    {
        $comment->approved = !$comment->approved;
        $comment->save();
        return redirect()->back()->with('success', 'Comment status updated.');
    }

    public function destroyComment(ReflectionComment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted.');
    }
}
