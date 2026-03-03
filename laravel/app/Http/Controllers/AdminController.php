<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Event;
use App\Models\Sermon;
use App\Models\User;
use App\Models\NewsletterSubscriber;
use App\Models\Rsvp;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'members' => User::where('role', 'member')->count(),
            'total_donations' => Donation::where('status', 'succeeded')->sum('amount') / 100,
            'donations_count' => Donation::where('status', 'succeeded')->count(),
            'upcoming_events' => Event::where('date', '>=', now())->count(),
            'recent_sermons' => Sermon::count(),
            'newsletter_subscribers' => NewsletterSubscriber::active()->count(),
            // basic dream count for dashboard stats
            'dreams' => \App\Models\Dream::count(),
        ];

        $recent_donations = Donation::where('status', 'succeeded')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $upcoming_events = Event::where('date', '>=', now())
            ->orderBy('date')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_donations', 'upcoming_events'));
    }

    public function pastor()
    {
        return view('pastor.dashboard');
    }

    public function analytics(Request $request)
    {
        $period = $request->input('period', '30');
        $startDate = now()->subDays($period);

        $donations = Donation::where('status', 'succeeded')
            ->where('created_at', '>=', $startDate)
            ->selectRaw('DATE(created_at) as date, SUM(amount) as total, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $donationStats = [
            'total' => $donations->sum('total') / 100,
            'count' => $donations->sum('count'),
            'average' => $donations->count() > 0 ? ($donations->avg('total') / 100) : 0,
        ];

        $eventStats = [
            'total' => Event::where('date', '>=', $startDate)->count(),
            'rsvps' => Rsvp::whereHas('event', function ($q) use ($startDate) {
                $q->where('date', '>=', $startDate);
            })->count(),
        ];

        $sermonStats = [
            'total' => Sermon::where('date', '>=', $startDate)->count(),
            'likes' => \App\Models\SermonLike::whereHas('sermon', function ($q) use ($startDate) {
                $q->where('date', '>=', $startDate);
            })->count(),
            'comments' => \App\Models\SermonComment::whereHas('sermon', function ($q) use ($startDate) {
                $q->where('date', '>=', $startDate);
            })->count(),
        ];

        $subscriberStats = [
            'new' => NewsletterSubscriber::where('created_at', '>=', $startDate)->count(),
            'unsubscribed' => NewsletterSubscriber::where('unsubscribed_at', '>=', $startDate)->count(),
            'total_active' => NewsletterSubscriber::active()->count(),
        ];

        $memberStats = [
            'new' => User::where('role', 'member')
                ->where('created_at', '>=', $startDate)
                ->count(),
            'total' => User::where('role', 'member')->count(),
        ];

        $donationsByProvider = Donation::where('status', 'succeeded')
            ->where('created_at', '>=', $startDate)
            ->selectRaw('provider, SUM(amount) as total, COUNT(*) as count')
            ->groupBy('provider')
            ->get();

        $donationsByFrequency = Donation::where('status', 'succeeded')
            ->where('created_at', '>=', $startDate)
            ->selectRaw('frequency, SUM(amount) as total, COUNT(*) as count')
            ->groupBy('frequency')
            ->get();

        return view('admin.analytics', compact(
            'period',
            'donationStats',
            'eventStats',
            'sermonStats',
            'subscriberStats',
            'memberStats',
            'donationsByProvider',
            'donationsByFrequency'
        ));
    }
}
