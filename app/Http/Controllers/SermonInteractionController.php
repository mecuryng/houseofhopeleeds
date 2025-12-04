<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sermon;
use App\Models\SermonComment;
use App\Models\SermonLike;

class SermonInteractionController extends Controller
{
    public function storeComment(Request $request, Sermon $sermon)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'content' => 'required|string|max:2000',
        ]);

        $data['user_id'] = auth()->id();
        $data['sermon_id'] = $sermon->id;

        SermonComment::create($data);

        return redirect()->back()->with('comment_success', 'Thank you — your comment was posted.');
    }

    public function toggleLike(Request $request, Sermon $sermon)
    {
        $userId = auth()->id();
        $sessionId = $request->session()->getId();

        $like = SermonLike::where('sermon_id', $sermon->id)
            ->when($userId, fn($q) => $q->where('user_id', $userId), fn($q) => $q->where('session_id', $sessionId))
            ->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            SermonLike::create([
                'sermon_id' => $sermon->id,
                'user_id' => $userId,
                'session_id' => $sessionId,
                'ip' => $request->ip(),
            ]);
            $liked = true;
        }

        $count = SermonLike::where('sermon_id', $sermon->id)->count();

        return response()->json(['liked' => $liked, 'count' => $count]);
    }

    /** Admin: list sermon comments with filters */
    public function indexComments(Request $request)
    {
        $query = SermonComment::with('sermon')->latest();

        if ($q = $request->query('q')) {
            $query->where(function ($qb) use ($q) {
                $qb->where('name', 'like', "%{$q}%")
                   ->orWhere('email', 'like', "%{$q}%")
                   ->orWhere('content', 'like', "%{$q}%");
            });
        }

        if ($sermonId = $request->query('sermon_id')) {
            $query->where('sermon_id', $sermonId);
        }

        $comments = $query->paginate(20)->withQueryString();
        return view('admin.sermon_comments.index', compact('comments'));
    }

    /** Admin: approve/unapprove a comment */
    public function approve(SermonComment $comment)
    {
        $comment->approved = !$comment->approved;
        $comment->save();
        return redirect()->back()->with('success', 'Comment status updated.');
    }

    /** Admin: delete a comment */
    public function destroyComment(SermonComment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted.');
    }
}
