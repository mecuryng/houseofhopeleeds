<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Fortify;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $user = auth()->user();

        // Redirect based on user role
        if ($user->role === 'admin') {
            return redirect()->intended(route('admin.dashboard'));
        } elseif ($user->role === 'pastor') {
            return redirect()->intended(route('pastor'));
        } else {
            // For members or any other role, redirect to home
            return redirect()->intended(route('home'));
        }

        // Fallback to Fortify's default behavior
        return redirect()->intended(Fortify::redirects('login'));
    }
}
