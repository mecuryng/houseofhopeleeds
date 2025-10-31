@extends('layouts.admin')

@section('content')
    <x-page-title>Members Management</x-page-title>

    <a href="{{ route('members.create') }}" style="background:#2563eb;color:white;padding:10px 15px;border-radius:5px;text-decoration:none;">+ Add New Member</a>
    <br><br>

    @if(session('success'))
        <div style="background:#d1fae5;color:#065f46;padding:10px;border-radius:5px;">
            {{ session('success') }}
        </div><br>
    @endif

    <table border="1" width="100%" cellpadding="10" cellspacing="0" style="border-collapse: collapse;">
        <tr style="background:#1e293b;color:white;">
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>DOB</th>
            <th>Action</th>
        </tr>

        @foreach($members as $member)
            <tr>
                <td>{{ $member->id }}</td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->email }}</td>
                <td>{{ $member->phone }}</td>
                <td>{{ $member->dob }}</td>
                <td>
                    <a href="{{ route('members.edit', $member->id) }}">Edit</a> |
                    <form action="{{ route('members.destroy', $member->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <div style="margin-top:15px;">
        {{ $members->links() }}
    </div>
@endsection
