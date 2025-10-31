@extends('layouts.admin')
<x-page-title>Members Management</x-page-title>
@section('content')
<h1>Welcome Pastor {{ auth()->user()->name }}</h1>
<p>This is your sermon management area (coming soon).</p>
@endsection
