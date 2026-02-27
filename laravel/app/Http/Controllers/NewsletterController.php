<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\NewsletterWelcomeMail;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'name' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first('email'),
            ], 422);
        }

        $subscriber = NewsletterSubscriber::withTrashed()
            ->where('email', $request->email)
            ->first();

        if ($subscriber) {
            if ($subscriber->trashed()) {
                $subscriber->restore();
                $subscriber->resubscribe();
            } elseif (!$subscriber->is_active) {
                $subscriber->resubscribe();
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'You are already subscribed to our newsletter!',
                ]);
            }
        } else {
            $subscriber = NewsletterSubscriber::create([
                'email' => $request->email,
                'name' => $request->name,
                'is_active' => true,
                'subscribed_at' => now(),
                'source' => 'website',
            ]);
        }

        if (config('mail.default') !== 'log') {
            try {
                Mail::to($subscriber->email)->queue(new NewsletterWelcomeMail($subscriber));
            } catch (\Exception $e) {
                \Log::warning('Failed to send newsletter welcome email: ' . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Thank you for subscribing to our newsletter!',
        ]);
    }

    public function unsubscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email address.',
            ], 422);
        }

        $subscriber = NewsletterSubscriber::where('email', $request->email)->first();

        if (!$subscriber) {
            return response()->json([
                'success' => true,
                'message' => 'You have been removed from our mailing list.',
            ]);
        }

        $subscriber->unsubscribe($request->reason);

        return response()->json([
            'success' => true,
            'message' => 'You have been successfully unsubscribed.',
        ]);
    }

    public function confirmUnsubscribe(string $token)
    {
        $subscriber = NewsletterSubscriber::where('email', base64_decode($token))->first();

        if (!$subscriber) {
            return redirect()->route('home')->with('error', 'Invalid unsubscribe link.');
        }

        $subscriber->unsubscribe();

        return redirect()->route('home')->with('success', 'You have been successfully unsubscribed from our newsletter.');
    }

    public function adminIndex(Request $request)
    {
        $query = NewsletterSubscriber::orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('email', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->input('status') === 'active');
        }

        $subscribers = $query->paginate(20)->withQueryString();

        return view('admin.newsletter.index', compact('subscribers'));
    }

    public function export(Request $request)
    {
        $subscribers = NewsletterSubscriber::active()
            ->orderBy('created_at', 'desc')
            ->get();

        $csv = "Email,Name,Subscribed At,Source\n";
        foreach ($subscribers as $subscriber) {
            $csv .= sprintf(
                "%s,%s,%s,%s\n",
                $subscriber->email,
                $subscriber->name ?? '',
                $subscriber->subscribed_at?->format('Y-m-d H:i:s') ?? '',
                $subscriber->source
            );
        }

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="newsletter-subscribers.csv"');
    }

    public function destroy(NewsletterSubscriber $subscriber)
    {
        $subscriber->delete();

        return redirect()->route('admin.newsletter.index')
            ->with('success', 'Subscriber deleted successfully.');
    }
}
