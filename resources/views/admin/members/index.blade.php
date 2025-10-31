@extends('layouts.admin')

@section('content')
    <h1>Members</h1>

    @if(session('success'))
        <div style="padding:10px;background:#d1fae5;border:1px solid #10b981;margin-bottom:16px;color:#065f46;">
            {{ session('success') }}
        </div>
    @endif

    <p><a href="{{ route('members.create') }}">Add new member</a></p>

    @if($members->count())
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr>
                    <th style="text-align:left;padding:8px;border-bottom:1px solid #e5e7eb;">Name</th>
                    <th style="text-align:left;padding:8px;border-bottom:1px solid #e5e7eb;">Email</th>
                    <th style="text-align:left;padding:8px;border-bottom:1px solid #e5e7eb;">Phone</th>
                    <th style="text-align:left;padding:8px;border-bottom:1px solid #e5e7eb;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($members as $member)
                    <tr>
                        <td style="padding:8px;border-bottom:1px solid #f3f4f6;">{{ $member->name }}</td>
                        <td style="padding:8px;border-bottom:1px solid #f3f4f6;">{{ $member->email }}</td>
                        <td style="padding:8px;border-bottom:1px solid #f3f4f6;">{{ $member->phone }}</td>
                        <td style="padding:8px;border-bottom:1px solid #f3f4f6;">
                            <a href="{{ route('members.edit', $member) }}">Edit</a>
                            |
                            <form action="{{ route('members.destroy', $member) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this member?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top:16px;">
            {{ $members->links() }}
        </div>
    @else
        <p>No members found.</p>
    @endif
@endsection
