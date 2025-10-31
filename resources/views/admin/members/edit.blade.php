@extends('layouts.admin')

@section('content')
    <h1>Edit Member</h1>

    @if ($errors->any())
        <div style="padding:10px;background:#fee2e2;border:1px solid #fca5a5;margin-bottom:16px;color:#7f1d1d;">
            <ul style="margin:0;padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('members.update', $member) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom:8px;">
            <label>Name</label><br>
            <input type="text" name="name" value="{{ old('name', $member->name) }}" style="width:100%;padding:8px;" required>
        </div>

        <div style="margin-bottom:8px;">
            <label>Email</label><br>
            <input type="email" name="email" value="{{ old('email', $member->email) }}" style="width:100%;padding:8px;" required>
        </div>

        <div style="margin-bottom:8px;">
            <label>Phone</label><br>
            <input type="text" name="phone" value="{{ old('phone', $member->phone) }}" style="width:100%;padding:8px;">
        </div>

        <div style="margin-bottom:8px;">
            <label>Address</label><br>
            <input type="text" name="address" value="{{ old('address', $member->address) }}" style="width:100%;padding:8px;">
        </div>

        <div style="margin-bottom:8px;">
            <label>Date of Birth</label><br>
            @php
                $dobValue = old('dob', '');
                if ($dobValue === '' && !empty($member->dob)) {
                    $timestamp = strtotime($member->dob);
                    $dobValue = $timestamp ? date('Y-m-d', $timestamp) : (string) $member->dob;
                }
            @endphp
            <input type="date" name="dob" value="{{ $dobValue }}" style="padding:8px;">
        </div>

        <div>
            <button type="submit" style="padding:8px 12px;background:#1e293b;color:#fff;border:none;">Update Member</button>
            <a href="{{ route('members.index') }}" style="margin-left:12px;">Cancel</a>
        </div>
    </form>
@endsection
