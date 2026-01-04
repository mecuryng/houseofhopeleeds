@extends('layouts.admin')

@section('title', 'Prayer Requests')
@section('content')
    <div class="admin-header">
        <div style="display:flex;justify-content:space-between;align-items:center;">
            <h1>Prayer Requests</h1>
            <div style="display:flex;gap:0.5rem;">
                @php $qs = http_build_query(request()->all()); @endphp
                <a href="{{ route('admin.prayer-requests.export-csv') }}{{ $qs ? '?'.$qs : '' }}" class="admin-btn-primary">Export CSV</a>
                <a href="{{ route('admin.prayer-requests.export-pdf') }}{{ $qs ? '?'.$qs : '' }}" class="admin-btn-primary" style="background:#059669;">Export PDF</a>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="admin-alert admin-alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" style="margin-bottom:2rem;display:flex;gap:1rem;flex-wrap:wrap;align-items:center;">
        <input type="text" name="q" placeholder="Search name, email or request" value="{{ request('q') }}" style="padding:0.5rem;border:1px solid #d1d5db;border-radius:6px;min-width:200px;" />
        <input type="date" name="from" value="{{ request('from') }}" style="padding:0.5rem;border:1px solid #d1d5db;border-radius:6px;" />
        <input type="date" name="to" value="{{ request('to') }}" style="padding:0.5rem;border:1px solid #d1d5db;border-radius:6px;" />
        <button class="admin-btn-primary" type="submit">Filter</button>
        <a href="{{ route('admin.prayer-requests.index') }}" class="admin-btn-primary" style="background:#6b7280;">Clear</a>
    </form>

    <div class="admin-table">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Request</th>
                    <th>Anonymous</th>
                    <th>Submitted</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($prayerRequests as $request)
                    <tr>
                        <td>{{ $request->id }}</td>
                        <td>{{ $request->name }}</td>
                        <td>{{ $request->email }}</td>
                        <td>{{ $request->phone ?: 'N/A' }}</td>
                        <td style="max-width:300px;word-wrap:break-word;">{{ Str::limit($request->request, 100) }}</td>
                        <td>{{ $request->is_anonymous ? 'Yes' : 'No' }}</td>
                        <td>{{ $request->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding:2rem;text-align:center;color:#6B7280;">No prayer requests found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($prayerRequests->hasPages())
        <div style="margin-top:2rem;">
            {{ $prayerRequests->links() }}
        </div>
    @endif
@endsection