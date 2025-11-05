@extends('layouts.admin')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;">
        <h1>Sermons</h1>
        <a href="{{ route('admin.sermons.create') }}" style="padding:8px 12px;background:#1e293b;color:#fff;border:none;text-decoration:none;">Add Sermon</a>
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
                <th style="padding:12px;text-align:left;">Pastor</th>
                <th style="padding:12px;text-align:left;">Date</th>
                <th style="padding:12px;text-align:left;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sermons as $sermon)
                <tr>
                    <td style="padding:12px;border-bottom:1px solid #e5e7eb;">{{ $sermon->title }}</td>
                    <td style="padding:12px;border-bottom:1px solid #e5e7eb;">{{ $sermon->pastor->name }}</td>
                    <td style="padding:12px;border-bottom:1px solid #e5e7eb;">{{ $sermon->date->format('M d, Y') }}</td>
                    <td style="padding:12px;border-bottom:1px solid #e5e7eb;">
                        <a href="{{ route('admin.sermons.edit', $sermon) }}" style="color:#3b82f6;text-decoration:none;">Edit</a>
                        <form action="{{ route('admin.sermons.destroy', $sermon) }}" method="POST" style="display:inline;margin-left:12px;" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="color:#ef4444;background:none;border:none;cursor:pointer;">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="padding:12px;text-align:center;">No sermons found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
