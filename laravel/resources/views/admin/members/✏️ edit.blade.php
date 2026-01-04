@extends('layouts.admin')

@section('content')
    <x-page-title>Edit Member</x-page-title>

    <form action="{{ route('members.update', $member->id) }}" method="POST">
        @csrf
        @method('PUT')

        <p><label>Name:</label><br>
        <input type="text" name="name" value="{{ old('name', $member->name) }}" required></p>

        <p><label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email', $member->email) }}" required></p>

        <p><label>Phone:</label><br>
        <input type="text" name="phone" value="{{ old('phone', $member->phone) }}"></p>

        <p><label>Address:</label><br>
        <input type="text" name="address" value="{{ old('address', $member->address) }}"></p>

        <p><label>Date of Birth:</label><br>
        <input type="date" name="dob" value="{{ old('dob', $member->dob) }}"></p>

        <button type="submit">Update Member</button>
    </form>
@endsection
