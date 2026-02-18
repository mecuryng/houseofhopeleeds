<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::latest()->paginate(20);
        return view('admin.donations.index', compact('donations'));
    }

    public function show(Donation $donation)
    {
        return view('admin.donations.show', compact('donation'));
    }

    public function destroy(Donation $donation)
    {
        $donation->delete();
        return redirect()->route('admin.donations.index')->with('success', 'Donation deleted.');
    }

    public function export()
    {
        $donations = Donation::all();
        $csv = "ID,Provider,Amount,Currency,Frequency,Status,Email,Created At\n";
        foreach ($donations as $d) {
            $amount = number_format($d->amount / 100, 2);
            $csv .= "{$d->id},{$d->provider},$amount,{$d->currency},{$d->frequency},{$d->status},{$d->email},{$d->created_at}\n";
        }
        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="donations.csv"',
        ]);
    }
}
