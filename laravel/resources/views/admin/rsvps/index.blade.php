@extends('layouts.admin')

@section('title', 'Event RSVPs')
@section('content')
    <div class="admin-header">
        <div style="display:flex;justify-content:space-between;align-items:center;">
            <h1>Event RSVPs</h1>
            @php $qs = http_build_query(request()->all()); @endphp
            <a href="{{ route('admin.rsvps.export') }}{{ $qs ? '?'.$qs : '' }}" class="admin-btn-primary">Export CSV</a>
        </div>
    </div>

    @if(session('success'))
        <div class="admin-alert admin-alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" style="margin-bottom:2rem;display:flex;gap:1rem;flex-wrap:wrap;align-items:center;">
        <input type="text" name="q" placeholder="Search name or email" value="{{ request('q') }}" style="padding:0.5rem;border:1px solid #d1d5db;border-radius:6px;min-width:200px;" />
        <select name="event_id" style="padding:0.5rem;border:1px solid #d1d5db;border-radius:6px;min-width:150px;">
            <option value="">All events</option>
            @foreach(App\Models\Event::orderBy('date','desc')->pluck('title','id') as $id => $title)
                <option value="{{ $id }}" {{ request('event_id') == $id ? 'selected' : '' }}>{{ $title }}</option>
            @endforeach
        </select>
        <input type="date" name="from" value="{{ request('from') }}" style="padding:0.5rem;border:1px solid #d1d5db;border-radius:6px;" />
        <input type="date" name="to" value="{{ request('to') }}" style="padding:0.5rem;border:1px solid #d1d5db;border-radius:6px;" />
        <button class="admin-btn-primary" type="submit">Filter</button>
    </form>

    <div class="admin-table">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Event</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Guests</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rsvps as $rsvp)
                <tr>
                    <td>{{ $rsvp->id }}</td>
                    <td><a href="{{ route('events.show', $rsvp->event_id) }}" style="color:#3b82f6;text-decoration:none;">{{ $rsvp->event->title ?? '—' }}</a></td>
                    <td>{{ $rsvp->name }}</td>
                    <td>{{ $rsvp->email }}</td>
                    <td>{{ $rsvp->guests_count }}</td>
                    <td style="max-width:250px;word-wrap:break-word;">{{ \Illuminate\Support\Str::limit($rsvp->message, 80) }}</td>
                    <td>{{ $rsvp->created_at->format('M d, Y H:i') }}</td>
                    <td>
                        <button class="admin-btn-primary" style="font-size:0.875rem;background:#6b7280;" data-rsvp-id="{{ $rsvp->id }}" onclick="window.showRsvp(event)">View</button>
                        <form action="{{ route('admin.rsvps.destroy', $rsvp->id) }}" method="POST" style="display:inline;margin-left:0.5rem;" onsubmit="return confirm('Delete this RSVP?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="admin-btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="padding:2rem;text-align:center;color:#6B7280;">No RSVPs found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($rsvps->hasPages())
        <div style="margin-top:2rem;">
            {{ $rsvps->links() }}
        </div>
    @endif
@endsection

@push('scripts')
<script>
        window.showRsvp = function(e) {
                const id = e.currentTarget.getAttribute('data-rsvp-id');
                if (!id) return;
                fetch("{{ url('/admin/rsvps') }}\/" + id)
                        .then(r => r.json())
                        .then(data => {
                                const modal = document.getElementById('rsvpModal');
                                modal.querySelector('.modal-title').textContent = data.name + ' — ' + (data.event ? data.event.title : '');
                                modal.querySelector('.rsvp-email').textContent = data.email;
                                modal.querySelector('.rsvp-guests').textContent = data.guests_count;
                                modal.querySelector('.rsvp-message').textContent = data.message || '(no message)';
                                modal.querySelector('.rsvp-date').textContent = new Date(data.created_at).toLocaleString();
                                // show bootstrap modal
                                var bsModal = new bootstrap.Modal(modal);
                                bsModal.show();
                        })
                        .catch(err => alert('Failed to load RSVP'));
        }
</script>

<!-- RSVP Detail Modal -->
<div class="modal fade" id="rsvpModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Email:</strong> <span class="rsvp-email"></span></p>
                <p><strong>Guests:</strong> <span class="rsvp-guests"></span></p>
                <p><strong>Message:</strong></p>
                <div class="rsvp-message p-2 bg-light rounded"></div>
                <p class="mt-3 text-muted"><small>Submitted: <span class="rsvp-date"></span></small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

