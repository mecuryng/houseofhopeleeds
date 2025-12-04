@extends('layouts.admin')

@section('content')
<x-page-title>RSVPs</x-page-title>

<div class="card p-3">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Filters + Export --}}
    <div class="mb-3 d-flex align-items-center gap-2">
        <form method="GET" class="d-flex gap-2" style="flex-wrap:wrap;">
            <input type="text" name="q" placeholder="Search name or email" value="{{ request('q') }}" class="form-control form-control-sm" />
            <select name="event_id" class="form-select form-select-sm">
                <option value="">All events</option>
                @foreach(App\Models\Event::orderBy('date','desc')->pluck('title','id') as $id => $title)
                    <option value="{{ $id }}" {{ request('event_id') == $id ? 'selected' : '' }}>{{ $title }}</option>
                @endforeach
            </select>
            <input type="date" name="from" value="{{ request('from') }}" class="form-control form-control-sm" />
            <input type="date" name="to" value="{{ request('to') }}" class="form-control form-control-sm" />
            <button class="btn btn-sm btn-primary" type="submit">Filter</button>
        </form>

        <div style="margin-left:auto;">
            @php $qs = http_build_query(request()->all()); @endphp
            <a href="{{ route('admin.rsvps.export') }}{{ $qs ? '?'.$qs : '' }}" class="btn btn-sm btn-outline-secondary">Export CSV</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Event</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Guests</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($rsvps as $rsvp)
                <tr>
                    <td>{{ $rsvp->id }}</td>
                    <td><a href="{{ route('events.show', $rsvp->event_id) }}">{{ $rsvp->event->title ?? '—' }}</a></td>
                    <td>{{ $rsvp->name }}</td>
                    <td>{{ $rsvp->email }}</td>
                    <td>{{ $rsvp->guests_count }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($rsvp->message, 80) }}</td>
                    <td>{{ $rsvp->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                            <div class="d-flex gap-1">
                                <button class="btn btn-sm btn-outline-secondary" data-rsvp-id="{{ $rsvp->id }}" onclick="window.showRsvp(event)">View</button>
                                <form action="{{ route('admin.rsvps.destroy', $rsvp->id) }}" method="POST" onsubmit="return confirm('Delete this RSVP?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $rsvps->links() }}
    </div>
</div>
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

