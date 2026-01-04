<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pastor Dashboard - House of Hope Church')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/church.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>

    <style>
        .pastor-navbar {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            color: white;
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .pastor-navbar .navbar-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .pastor-navbar .logo-section {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .pastor-navbar .logo {
            width: 40px;
            height: 40px;
        }
        .pastor-navbar h2 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 600;
        }
        .pastor-navbar .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
        }
        .pastor-navbar .nav-links a {
            color: #cbd5e1;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        .pastor-navbar .nav-links a:hover {
            background: rgba(59, 130, 246, 0.1);
            color: #fff;
        }
        .pastor-navbar .logout-btn {
            background: #dc2626;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: background 0.3s ease;
        }
        .pastor-navbar .logout-btn:hover {
            background: #b91c1c;
        }
        .pastor-main {
            min-height: calc(100vh - 80px);
            background: #f8fafc;
        }
        .pastor-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }
        .pastor-header {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
            text-align: center;
        }
        .pastor-header h1 {
            margin: 0 0 0.5rem 0;
            color: #1e293b;
            font-weight: 700;
            font-size: 2rem;
        }
        .pastor-header p {
            margin: 0;
            color: #6b7280;
            font-size: 1.1rem;
        }
        .pastor-content {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        .pastor-btn-primary {
            background: #3b82f6;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
            cursor: pointer;
        }
        .pastor-btn-primary:hover {
            background: #2563eb;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        .pastor-btn-secondary {
            background: #6b7280;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
            cursor: pointer;
        }
        .pastor-btn-secondary:hover {
            background: #4b5563;
            transform: translateY(-1px);
        }
        .pastor-btn-danger {
            background: #dc2626;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.875rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .pastor-btn-danger:hover {
            background: #b91c1c;
        }
        .pastor-alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }
        .pastor-alert-success {
            background: #dcfce7;
            border: 1px solid #bbf7d0;
            color: #166534;
        }
        .pastor-alert-error {
            background: #fee2e2;
            border: 1px solid #fecaca;
            color: #dc2626;
        }

        @media (max-width: 768px) {
            .pastor-navbar .navbar-content {
                flex-direction: column;
                gap: 1rem;
            }
            .pastor-navbar .nav-links {
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <nav class="pastor-navbar">
        <div class="navbar-content">
            <div class="logo-section">
                <img src="{{ asset('Logo.png') }}" alt="House of Hope Church" class="logo">
                <h2>Pastor Dashboard</h2>
            </div>
            <div class="nav-links">
                <a href="{{ route('pastor') }}">📊 Dashboard</a>
                <a href="{{ route('pastor.sermons.index') }}">📖 My Sermons</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="logout-btn">🚪 Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="pastor-main">
        <div class="pastor-container">
            @yield('content')
        </div>
    </main>

    @stack('scripts')
</body>
</html>