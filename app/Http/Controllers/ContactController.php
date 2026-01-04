<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['name', 'email', 'subject', 'message']);

        $subject = $data['subject'] ?? 'Contact Form Submission';
        $body = $data['message'];
        if (!empty($data['phone'])) {
            $body .= "\n\nPhone: " . $data['phone'];
        }

        Mail::raw($body, function ($message) use ($data, $subject) {
            $message->to('info@houseofhopeleeds.org')
                    ->subject($subject)
                    ->from($data['email'], $data['name']);
        });

        return back()->with('success', 'Your message has been sent successfully!');
    }
}