<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>House of Hope Church Leeds - Admin Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body {
                background: linear-gradient(135deg, #1e40af 0%, #059669 100%);
            }
            .admin-logo {
                width: 80px;
                height: 80px;
                border-radius: 50%;
                background: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1rem auto;
                box-shadow: 0 4px 16px rgba(30,64,175,0.15);
            }
            .admin-heading {
                color: #1e40af;
                font-weight: 700;
                text-align: center;
                margin-bottom: 1rem;
                font-size: 2rem;
            }
            .admin-subheading {
                color: #059669;
                text-align: center;
                margin-bottom: 2rem;
                font-size: 1.1rem;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="admin-logo">
                <img src="/images/church-bg.png" alt="House of Hope Church Logo" style="width:60px;height:60px;border-radius:50%;">
            </div>
            <div class="admin-heading">House of Hope Church Leeds</div>
            <div class="admin-subheading">Admin Login</div>
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
