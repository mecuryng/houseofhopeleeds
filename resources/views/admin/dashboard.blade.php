@extends('layouts.admin')


@section('content')
<x-page-title>Members Management</x-page-title>
    <h1>Welcome, {{ auth()->user()->name }}</h1>
    <p>Role: <strong>{{ ucfirst(auth()->user()->role) }}</strong></p>
    <hr>
    <div>
        <h3>Quick Stats (coming soon)</h3>
        <ul>
            <li>Total Members: --</li>
            <li>Upcoming Events: --</li>
            <li>Total Donations: --</li>
        </ul>
    </div>
@endsection
