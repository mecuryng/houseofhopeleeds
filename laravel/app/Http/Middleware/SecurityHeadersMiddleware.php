<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeadersMiddleware
{
    protected array $securityHeaders = [
        'X-Content-Type-Options' => 'nosniff',
        'X-Frame-Options' => 'SAMEORIGIN',
        'X-XSS-Protection' => '1; mode=block',
        'Referrer-Policy' => 'strict-origin-when-cross-origin',
        'Permissions-Policy' => 'geolocation=(), microphone=(), camera=()',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        foreach ($this->securityHeaders as $header => $value) {
            $response->headers->set($header, $value);
        }

        $response->headers->set(
            'Content-Security-Policy',
            $this->buildContentSecurityPolicy()
        );

        if ($request->isSecure()) {
            $response->headers->set(
                'Strict-Transport-Security',
                'max-age=31536000; includeSubDomains; preload'
            );
        }

        return $response;
    }

    protected function buildContentSecurityPolicy(): string
    {
        $policies = [
            "default-src 'self'",
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://js.stripe.com https://www.paypal.com https://www.google-analytics.com",
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://fonts.bunny.net https://cdn.jsdelivr.net https://cdnjs.cloudflare.com",
            "font-src 'self' https://fonts.gstatic.com https://fonts.bunny.net data:",
            "img-src 'self' data: https: blob:",
            "frame-src 'self' https://js.stripe.com https://www.paypal.com https://www.youtube.com https://player.vimeo.com https://www.google.com",
            "connect-src 'self' https://api.stripe.com https://api-m.paypal.com https://www.google-analytics.com",
            "object-src 'none'",
            "base-uri 'self'",
            "form-action 'self'",
            "frame-ancestors 'self'",
        ];

        return implode('; ', $policies);
    }
}
