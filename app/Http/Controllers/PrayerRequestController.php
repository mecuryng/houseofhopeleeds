<?php

namespace App\Http\Controllers;

use App\Models\PrayerRequest;
use Illuminate\Http\Request;

class PrayerRequestController extends Controller
{
    public function index()
    {
        return view('public.prayer');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'request' => 'required|string|max:1000',
            'is_anonymous' => 'boolean',
        ]);

        PrayerRequest::create($request->all());

        return back()->with('success', 'Your prayer request has been submitted. We will pray for you.');
    }

    // Admin methods
    public function adminIndex(Request $request)
    {
        $query = PrayerRequest::query();

        // Search filter
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('request', 'like', "%{$search}%");
            });
        }

        // Date filters
        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        $prayerRequests = $query->latest()->paginate(20)->withQueryString();

        return view('admin.prayer_requests.index', compact('prayerRequests'));
    }

    public function exportCsv(Request $request)
    {
        $query = PrayerRequest::query();

        // Apply same filters as index
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('request', 'like', "%{$search}%");
            });
        }

        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        $prayerRequests = $query->latest()->get();

        $filename = 'prayer_requests_' . now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($prayerRequests) {
            $file = fopen('php://output', 'w');

            // CSV headers
            fputcsv($file, ['ID', 'Name', 'Email', 'Phone', 'Request', 'Anonymous', 'Submitted At']);

            // Data rows
            foreach ($prayerRequests as $prayerRequest) {
                fputcsv($file, [
                    $prayerRequest->id,
                    $prayerRequest->name,
                    $prayerRequest->email,
                    $prayerRequest->phone ?: 'N/A',
                    $prayerRequest->request,
                    $prayerRequest->is_anonymous ? 'Yes' : 'No',
                    $prayerRequest->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        $query = PrayerRequest::query();

        // Apply same filters as index
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('request', 'like', "%{$search}%");
            });
        }

        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        $prayerRequests = $query->latest()->get();

        // For PDF, we'll use a simple HTML to PDF approach
        // You might want to install a PDF library like dompdf or tcpdf
        $html = '<h1>Prayer Requests Report</h1>';
        $html .= '<p>Generated on: ' . now()->format('Y-m-d H:i:s') . '</p>';
        $html .= '<table border="1" style="width:100%;border-collapse:collapse;">';
        $html .= '<thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Request</th><th>Anonymous</th><th>Submitted</th></tr></thead>';
        $html .= '<tbody>';

        foreach ($prayerRequests as $prayerRequest) {
            $html .= '<tr>';
            $html .= '<td>' . $prayerRequest->id . '</td>';
            $html .= '<td>' . htmlspecialchars($prayerRequest->name) . '</td>';
            $html .= '<td>' . htmlspecialchars($prayerRequest->email) . '</td>';
            $html .= '<td>' . htmlspecialchars($prayerRequest->phone ?: 'N/A') . '</td>';
            $html .= '<td>' . htmlspecialchars($prayerRequest->request) . '</td>';
            $html .= '<td>' . ($prayerRequest->is_anonymous ? 'Yes' : 'No') . '</td>';
            $html .= '<td>' . $prayerRequest->created_at->format('Y-m-d H:i:s') . '</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody></table>';

        $filename = 'prayer_requests_' . now()->format('Y-m-d_H-i-s') . '.html';

        return response($html)
            ->header('Content-Type', 'text/html')
            ->header('Content-Disposition', "attachment; filename=\"{$filename}\"");
    }
}
