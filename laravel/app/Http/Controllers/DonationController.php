<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use App\Models\Donation;

class DonationController extends Controller
{
    public function createStripeSession(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'frequency' => 'required|in:one_time,recurring',
            'email' => 'nullable|email',
        ]);

        $amount = intval(round($request->input('amount') * 100));
        $frequency = $request->input('frequency');
        $currency = 'usd';

        $donation = Donation::create([
            'user_id' => auth()->id(),
            'provider' => 'stripe',
            'amount' => $amount,
            'currency' => $currency,
            'frequency' => $frequency,
            'status' => 'pending',
            'email' => $request->input('email'),
        ]);

        $secret = config('services.stripe.secret');
        if (! $secret) {
            return response()->json(['error' => 'Stripe not configured'], 500);
        }

        $data = [
            'success_url' => route('donate.success'),
            'cancel_url' => route('donate.cancel'),
            'payment_method_types[]' => 'card',
        ];

        if ($frequency === 'one_time') {
            $data['mode'] = 'payment';
            $data['line_items[0][price_data][currency]'] = $currency;
            $data['line_items[0][price_data][product_data][name]'] = 'Donation';
            $data['line_items[0][price_data][unit_amount]'] = $amount;
            $data['line_items[0][quantity]'] = 1;
        } else {
            $data['mode'] = 'subscription';
            $data['line_items[0][price_data][currency]'] = $currency;
            $data['line_items[0][price_data][product_data][name]'] = 'Recurring Donation';
            $data['line_items[0][price_data][unit_amount]'] = $amount;
            $data['line_items[0][price_data][recurring][interval]'] = 'month';
            $data['line_items[0][quantity]'] = 1;
        }

        // create checkout session via Stripe API
        $ch = curl_init('https://api.stripe.com/v1/checkout/sessions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $secret . ':');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        $resp = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($resp === false) {
            $err = curl_error($ch);
            curl_close($ch);
            Log::error('Stripe curl error: ' . $err);
            return response()->json(['error' => 'Stripe request failed'], 500);
        }
        curl_close($ch);

        $json = json_decode($resp, true);
        if ($httpcode >= 400) {
            Log::error('Stripe error: ' . $resp);
            return response()->json(['error' => $json['error']['message'] ?? 'Stripe error'], $httpcode);
        }

        // store provider id (session id)
        $donation->provider_id = $json['id'] ?? null;
        $donation->save();

        return response()->json(['id' => $json['id'], 'url' => $json['url'] ?? null]);
    }

    public function stripeWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $secret = config('services.stripe.webhook_secret');

        if ($secret) {
            if (! $this->verifyStripeSignature($payload, $sigHeader, $secret)) {
                return response('Invalid signature', 400);
            }
        }

        $event = json_decode($payload, true);
        if (! $event) {
            return response('Invalid payload', 400);
        }

        $type = $event['type'] ?? '';
        if ($type === 'checkout.session.completed') {
            $session = $event['data']['object'] ?? null;
            $sessionId = $session['id'] ?? null;
            // find donation by provider_id
            $donation = Donation::where('provider', 'stripe')->where('provider_id', $sessionId)->first();
            if ($donation) {
                $donation->status = 'succeeded';
                $donation->save();
                // send receipt email
                if ($donation->email) {
                    Mail::to($donation->email)->send(new \App\Mail\DonationReceiptMail($donation));
                }
            }
        }

        return response('OK', 200);
    }

    protected function verifyStripeSignature($payload, $sigHeader, $secret)
    {
        if (! $sigHeader) return false;
        // parse header: t=...,v1=...,v0=...
        $parts = explode(',', $sigHeader);
        $timestamp = null;
        $v1 = null;
        foreach ($parts as $p) {
            [$k, $v] = explode('=', $p, 2) + [null, null];
            if ($k === 't') $timestamp = $v;
            if ($k === 'v1') $v1 = $v;
        }
        if (! $timestamp || ! $v1) return false;
        $signed_payload = $timestamp . '.' . $payload;
        $expected = hash_hmac('sha256', $signed_payload, $secret);
        return hash_equals($expected, $v1);
    }

    public function createPaypalOrder(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'frequency' => 'required|in:one_time,recurring',
            'email' => 'nullable|email',
        ]);

        $amount = number_format($request->input('amount'), 2, '.', '');
        $frequency = $request->input('frequency');

        $donation = Donation::create([
            'user_id' => auth()->id(),
            'provider' => 'paypal',
            'amount' => intval(round($amount * 100)),
            'currency' => 'USD',
            'frequency' => $frequency,
            'status' => 'pending',
            'email' => $request->input('email'),
        ]);

        // get access token
        $clientId = config('services.paypal.client_id');
        $secret = config('services.paypal.secret');
        $mode = config('services.paypal.mode', 'sandbox');
        $base = $mode === 'live' ? 'https://api-m.paypal.com' : 'https://api-m.sandbox.paypal.com';

        $ch = curl_init($base . '/v1/oauth2/token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $clientId . ':' . $secret);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');

        $resp = curl_exec($ch);
        if ($resp === false) { curl_close($ch); return response()->json(['error' => 'PayPal auth failed'], 500); }
        $json = json_decode($resp, true);
        $access = $json['access_token'] ?? null;
        curl_close($ch);
        if (! $access) return response()->json(['error' => 'PayPal auth failed'], 500);

        if ($frequency === 'one_time') {
            // create order
            $body = [
                'intent' => 'CAPTURE',
                'purchase_units' => [[
                    'amount' => ['currency_code' => 'USD', 'value' => $amount],
                    'reference_id' => (string) $donation->id,
                ]],
                'application_context' => [
                    'return_url' => route('donate.success'),
                    'cancel_url' => route('donate.cancel'),
                ],
            ];

            $ch = curl_init($base . '/v2/checkout/orders');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $access,
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
            $resp = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            if ($resp === false) return response()->json(['error' => 'PayPal order failed'], 500);
            $json = json_decode($resp, true);
            return response()->json($json);
        }

        // recurring: create product -> plan -> subscription
        // create product
        $productBody = ['name' => 'Recurring Donation', 'type' => 'SERVICE'];
        $ch = curl_init($base . '/v1/catalogs/products');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Authorization: Bearer ' . $access]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($productBody));
        $resp = curl_exec($ch);
        $product = json_decode($resp, true);
        $productId = $product['id'] ?? null;
        if (! $productId) return response()->json(['error' => 'PayPal product creation failed'], 500);

        $planBody = [
            'product_id' => $productId,
            'name' => 'Monthly Donation',
            'billing_cycles' => [[
                'frequency' => ['interval_unit' => 'MONTH', 'interval_count' => 1],
                'tenure_type' => 'REGULAR',
                'sequence' => 1,
                'total_cycles' => 0,
                'pricing_scheme' => ['fixed_price' => ['value' => $amount, 'currency_code' => 'USD']],
            ]],
            'payment_preferences' => ['auto_bill_outstanding' => true, 'setup_fee' => ['value' => '0', 'currency_code' => 'USD']],
        ];

        $ch = curl_init($base . '/v1/billing/plans');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Authorization: Bearer ' . $access]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($planBody));
        $resp = curl_exec($ch);
        $plan = json_decode($resp, true);
        $planId = $plan['id'] ?? null;
        if (! $planId) return response()->json(['error' => 'PayPal plan creation failed'], 500);

        // create subscription
        $subBody = ['plan_id' => $planId, 'application_context' => ['return_url' => route('donate.success'), 'cancel_url' => route('donate.cancel')]];
        $ch = curl_init($base . '/v1/billing/subscriptions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Authorization: Bearer ' . $access]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($subBody));
        $resp = curl_exec($ch);
        $sub = json_decode($resp, true);
        return response()->json($sub);
    }

    public function paypalWebhook(Request $request)
    {
        $payload = $request->all();
        $clientId = config('services.paypal.client_id');
        $secret = config('services.paypal.secret');
        $webhookId = env('PAYPAL_WEBHOOK_ID');
        $mode = config('services.paypal.mode', 'sandbox');
        $base = $mode === 'live' ? 'https://api-m.paypal.com' : 'https://api-m.sandbox.paypal.com';

        // get access token
        $ch = curl_init($base . '/v1/oauth2/token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $clientId . ':' . $secret);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
        $resp = curl_exec($ch);
        if ($resp === false) { curl_close($ch); return response('Auth failed', 500); }
        $json = json_decode($resp, true);
        $access = $json['access_token'] ?? null;
        curl_close($ch);
        if (! $access) return response('Auth failed', 500);

        // verify webhook signature
        if ($webhookId && isset($payload['id'])) {
            $verifyBody = [
                'transmission_id' => $request->header('Paypal-Transmission-Id'),
                'transmission_time' => $request->header('Paypal-Transmission-Time'),
                'cert_url' => $request->header('Paypal-Cert-Url'),
                'auth_algo' => $request->header('Paypal-Auth-Algo'),
                'transmission_sig' => $request->header('Paypal-Transmission-Sig'),
                'webhook_id' => $webhookId,
                'webhook_event' => $payload,
            ];
            $ch = curl_init($base . '/v1/notifications/verify-webhook-signature');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $access,
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($verifyBody));
            $resp = curl_exec($ch);
            $verifyResp = json_decode($resp, true);
            curl_close($ch);
            if (($verifyResp['verification_status'] ?? null) !== 'SUCCESS') {
                Log::warning('PayPal webhook verification failed: ' . $resp);
                return response('Verification failed', 401);
            }
        }

        $event = $payload['event_type'] ?? null;
        $resource = $payload['resource'] ?? [];
        
        if ($event === 'PAYMENT.CAPTURE.COMPLETED') {
            // Extract donation reference from custom_id or reference_id
            $donationId = $resource['custom_id'] ?? $resource['supplementary_data']['related_ids']['order_reference_id'] ?? null;
            $donation = Donation::find($donationId);
            if ($donation && $donation->provider === 'paypal') {
                $donation->provider_id = $resource['id'] ?? null;
                $donation->status = 'succeeded';
                $donation->save();
                if ($donation->email) {
                    Mail::to($donation->email)->send(new \App\Mail\DonationReceiptMail($donation));
                }
            }
        } elseif ($event === 'BILLING.SUBSCRIPTION.CREATED' || $event === 'BILLING.SUBSCRIPTION.UPDATED') {
            // subscription confirmation; mark donation as recurring
            $subId = $resource['id'] ?? null;
            $donation = Donation::where('provider', 'paypal')->where('frequency', 'recurring')->whereNull('provider_id')->first();
            if ($donation) {
                $donation->provider_id = $subId;
                $donation->status = 'succeeded';
                $donation->save();
                if ($donation->email) {
                    Mail::to($donation->email)->send(new \App\Mail\DonationReceiptMail($donation));
                }
            }
        }

        return response('OK', 200);
    }

    public function success()
    {
        return redirect()->route('donate')->with('success', 'Thank you — your donation is being processed.');
    }

    public function cancel()
    {
        return redirect()->route('donate')->with('error', 'Donation cancelled.');
    }
}
