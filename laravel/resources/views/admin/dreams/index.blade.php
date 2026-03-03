@extends('layouts.admin')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;">
        <h1>Revelations &amp; Visions</h1>
        <a href="{{ route('admin.dreams.create') }}" style="padding:8px 12px;background:#1e293b;color:#fff;border:none;text-decoration:none;">Add Revelation</a>
    </div>

    @if (session('success'))
        <div style="padding:10px;background:#dcfce7;border:1px solid #bbf7d0;margin-bottom:16px;color:#166534;">
            {{ session('success') }}
        </div>
    @endif

    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr style="background:#f3f4f6;">
                <th style="padding:12px;text-align:left;">Title</th>
                <th style="padding:12px;text-align:left;">Posted By</th>
                <th style="padding:12px;text-align:left;">Date</th>
                <th style="padding:12px;text-align:left;">Attachment</th>
                <th style="padding:12px;text-align:left;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dreams as $dream)
                <tr>
                    <td style="padding:12px;border-bottom:1px solid #e5e7eb;">{{ $dream->title }}</td>
                    <td style="padding:12px;border-bottom:1px solid #e5e7eb;">{{ $dream->user?->name }}</td>
                    <td style="padding:12px;border-bottom:1px solid #e5e7eb;">{{ $dream->created_at->format('M d, Y') }}</td>
                    <td style="padding:12px;border-bottom:1px solid #e5e7eb;">
                        @if($dream->attachment_path)
                            <a href="{{ asset('storage/' . $dream->attachment_path) }}" target="_blank" class="text-decoration-none">View</a>
                        @else
                            —
                        @endif
                    </td>
                    <td style="padding:12px;border-bottom:1px solid #e5e7eb;">
                        <a href="{{ route('admin.dreams.edit', $dream) }}" style="color:#3b82f6;text-decoration:none;">Edit</a>
                        <form action="{{ route('admin.dreams.destroy', $dream) }}" method="POST" style="display:inline;margin-left:12px;" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="color:#ef4444;background:none;border:none;cursor:pointer;">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="padding:12px;text-align:center;">No revelations found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
