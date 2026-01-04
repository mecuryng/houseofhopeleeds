<?php

namespace App\Http\Controllers;

use App\Models\Rsvp;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class RsvpController extends Controller
{
    /** Store an RSVP for an event. */
    public function store(Request $request, Event $event)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'guests_count' => 'nullable|integer|min:1|max:100',
            'message' => 'nullable|string|max:2000',
        ]);

        $rsvp = new Rsvp();
        $rsvp->event_id = $event->id;
        $rsvp->name = $data['name'];
        $rsvp->email = $data['email'];
        $rsvp->guests_count = $data['guests_count'] ?? 1;
        $rsvp->message = $data['message'] ?? null;
        $rsvp->save();

        return redirect()->back()->with('rsvp_success', 'Thanks — your RSVP has been recorded.');
    }

    /** Admin: list RSVPs */
    public function index(Request $request)
    {
        $query = Rsvp::with('event')->latest();

        if ($q = $request->query('q')) {
            $query->where(function ($qb) use ($q) {
                $qb->where('name', 'like', "%{$q}%")
                   ->orWhere('email', 'like', "%{$q}%");
            });
        }

        if ($eventId = $request->query('event_id')) {
            $query->where('event_id', $eventId);
        }

        if ($from = $request->query('from')) {
            $query->whereDate('created_at', '>=', $from);
        }
        if ($to = $request->query('to')) {
            $query->whereDate('created_at', '<=', $to);
        }

        $rsvps = $query->paginate(20)->withQueryString();
        return view('admin.rsvps.index', compact('rsvps'));
    }

    /** Admin: show RSVP details as JSON (used by modal) */
    public function show(Rsvp $rsvp)
    {
        return response()->json($rsvp->load('event'));
    }

    /** Admin: export RSVPs (CSV) */
    public function export(Request $request)
    {
        $query = Rsvp::with('event')->latest();

        if ($q = $request->query('q')) {
            $query->where(function ($qb) use ($q) {
                $qb->where('name', 'like', "%{$q}%")
                   ->orWhere('email', 'like', "%{$q}%");
            });
        }
        if ($eventId = $request->query('event_id')) {
            $query->where('event_id', $eventId);
        }
        if ($from = $request->query('from')) {
            $query->whereDate('created_at', '>=', $from);
        }
        if ($to = $request->query('to')) {
            $query->whereDate('created_at', '<=', $to);
        }

        $filename = 'rsvps_'.date('Ymd_His').'.csv';
        $callback = function () use ($query) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID','Event','Name','Email','Guests','Message','Created At']);

            $query->chunk(200, function ($rows) use ($handle) {
                foreach ($rows as $r) {
                    fputcsv($handle, [
                        $r->id,
                        $r->event->title ?? '',
                        $r->name,
                        $r->email,
                        $r->guests_count,
                        $r->message,
                        $r->created_at->toDateTimeString(),
                    ]);
                }
            });

            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }

    /** Admin: delete RSVP */
    public function destroy(Rsvp $rsvp)
    {
        $rsvp->delete();
        return redirect()->route('admin.rsvps.index')->with('success', 'RSVP removed.');
    }
}
