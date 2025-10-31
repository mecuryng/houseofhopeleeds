@extends('layouts.admin')

@section('content')
    <x-page-title>Add New Member</x-page-title>

    <form action="{{ route('members.store') }}" method="POST">
        @csrf
        <p><label>Name:</label><br>
        <input type="text" name="name" value="{{ old('name') }}" required></p>

        <p><label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}" required></p>

        <p><label>Phone:</label><br>
        <input type="text" name="phone" value="{{ old('phone') }}"></p>

        <p><label>Address:</label><br>
        <input type="text" name="address" value="{{ old('address') }}"></p>

        <p><label>Date of Birth:</label><br>
        <input type="date" name="dob" value="{{ old('dob') }}"></p>

        <button type="submit">Save Member</button>
    </form>
@endsection
