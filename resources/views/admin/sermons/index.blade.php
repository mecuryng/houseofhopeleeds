@extends('layouts.admin')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem;">
        <h1 style="font-family:'Poppins',sans-serif;font-size:2rem;font-weight:600;color:#1A1A1A;margin:0;">Sermons</h1>
        <a href="{{ route('admin.sermons.create') }}" style="padding:0.75rem 1.5rem;background:#3A6EA5;color:#fff;border:none;text-decoration:none;border-radius:0.375rem;font-family:'Nunito Sans',sans-serif;font-size:0.9375rem;font-weight:500;cursor:pointer;transition:all 0.2s;box-shadow:0 1px 3px rgba(58,110,165,0.3);" onmouseover="this.style.background='#2d5582';this.style.boxShadow='0 4px 6px rgba(58,110,165,0.4)';" onmouseout="this.style.background='#3A6EA5';this.style.boxShadow='0 1px 3px rgba(58,110,165,0.3)';">+ Add Sermon</a>
    </div>

    @if (session('success'))
        <div style="padding:1rem;background:#dcfce7;border-left:4px solid #10b981;margin-bottom:1.5rem;color:#065f46;border-radius:0.375rem;font-family:'Nunito Sans',sans-serif;">
            {{ session('success') }}
        </div>
    @endif

    <table style="width:100%;border-collapse:collapse;background:white;border-radius:0.375rem;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.1);">
        <thead>
            <tr style="background:#3A6EA5;color:white;">
                <th style="padding:1rem;text-align:left;font-family:'Poppins',sans-serif;font-weight:600;font-size:0.875rem;text-transform:uppercase;letter-spacing:0.05em;">Title</th>
                <th style="padding:1rem;text-align:left;font-family:'Poppins',sans-serif;font-weight:600;font-size:0.875rem;text-transform:uppercase;letter-spacing:0.05em;">Pastor</th>
                <th style="padding:1rem;text-align:left;font-family:'Poppins',sans-serif;font-weight:600;font-size:0.875rem;text-transform:uppercase;letter-spacing:0.05em;">Date</th>
                <th style="padding:1rem;text-align:left;font-family:'Poppins',sans-serif;font-weight:600;font-size:0.875rem;text-transform:uppercase;letter-spacing:0.05em;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sermons as $sermon)
                <tr style="border-bottom:1px solid #e5e7eb;transition:background 0.2s;" onmouseover="this.style.background='#f8f9fa';" onmouseout="this.style.background='transparent';">
                    <td style="padding:1rem;border-bottom:1px solid #e5e7eb;font-family:'Nunito Sans',sans-serif;color:#1A1A1A;">{{ $sermon->title }}</td>
                    <td style="padding:1rem;border-bottom:1px solid #e5e7eb;font-family:'Nunito Sans',sans-serif;color:#1A1A1A;">{{ $sermon->pastor->name }}</td>
                    <td style="padding:1rem;border-bottom:1px solid #e5e7eb;font-family:'Nunito Sans',sans-serif;color:#1A1A1A;">{{ $sermon->date->format('M d, Y') }}</td>
                    <td style="padding:1rem;border-bottom:1px solid #e5e7eb;">
                        <a href="{{ route('admin.sermons.edit', $sermon) }}" style="color:#3A6EA5;text-decoration:none;font-family:'Nunito Sans',sans-serif;font-weight:500;margin-right:1rem;transition:color 0.2s;" onmouseover="this.style.color='#DAA520';" onmouseout="this.style.color='#3A6EA5';">Edit</a>
                        <form action="{{ route('admin.sermons.destroy', $sermon) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
            <button type="submit" style="color:#ef4444;background:none;border:none;cursor:pointer;font-family:'Nunito Sans',sans-serif;font-weight:500;transition:color 0.2s;" onmouseover="this.style.color='#dc2626';" onmouseout="this.style.color='#ef4444';">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="padding:1.5rem;text-align:center;font-family:'Nunito Sans',sans-serif;color:#6B7280;">No sermons found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
