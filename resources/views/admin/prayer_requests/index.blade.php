@extends('layouts.admin')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;">
        <h1>Prayer Requests</h1>
    </div>

    @if (session('success'))
        <div style="padding:10px;background:#dcfce7;border:1px solid #bbf7d0;margin-bottom:16px;color:#166534;">
            {{ session('success') }}
        </div>
    @endif

    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr style="background:#f3f4f6;">
                <th style="padding:12px;text-align:left;">Name</th>
                <th style="padding:12px;text-align:left;">Email</th>
                <th style="padding:12px;text-align:left;">Phone</th>
                <th style="padding:12px;text-align:left;">Request</th>
                <th style="padding:12px;text-align:left;">Anonymous</th>
                <th style="padding:12px;text-align:left;">Submitted</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($prayerRequests as $request)
                <tr>
                    <td style="padding:12px;border-bottom:1px solid #e5e7eb;">{{ $request->name }}</td>
                    <td style="padding:12px;border-bottom:1px solid #e5e7eb;">{{ $request->email }}</td>
                    <td style="padding:12px;border-bottom:1px solid #e5e7eb;">{{ $request->phone ?: 'N/A' }}</td>
                    <td style="padding:12px;border-bottom:1px solid #e5e7eb;max-width:300px;word-wrap:break-word;">{{ Str::limit($request->request, 100) }}</td>
                    <td style="padding:12px;border-bottom:1px solid #e5e7eb;">{{ $request->is_anonymous ? 'Yes' : 'No' }}</td>
                    <td style="padding:12px;border-bottom:1px solid #e5e7eb;">{{ $request->created_at->format('M d, Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="padding:12px;text-align:center;">No prayer requests found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($prayerRequests->hasPages())
        <div style="margin-top:20px;">
            {{ $prayerRequests->links() }}
        </div>
    @endif
@endsection