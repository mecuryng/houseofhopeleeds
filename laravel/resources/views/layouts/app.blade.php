<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#1e40af">
    <title>{{ config('app.name', 'House of Hope') }} - @yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        (function() {
            const theme = localStorage.getItem('theme') || 
                (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
    @vite(['resources/css/app.css', 'resources/css/church.css'])
</head>
<body class="min-h-screen d-flex flex-column">
    <a href="#main-content" class="visually-hidden-focusable position-absolute top-0 start-0 z-3 m-2 px-3 py-2 bg-primary text-white rounded">
        Skip to main content
    </a>

    @include('partials.nav')

    <main id="main-content" class="flex-grow-1" tabindex="-1">
        @yield('content')
    </main>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @vite([ 'resources/js/app.js', 'resources/js/church.js'])
    <script>
        const themeToggle = document.getElementById('theme-toggle');
        if (themeToggle) {
            themeToggle.addEventListener('click', function() {
                const html = document.documentElement;
                const isDark = html.classList.toggle('dark');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
                this.setAttribute('aria-pressed', isDark);
                this.setAttribute('aria-label', isDark ? 'Switch to light mode' : 'Switch to dark mode');
            });
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            const mainContent = document.getElementById('main-content');
            if (mainContent && window.location.hash === '') {
                mainContent.focus();
            }
            
            const newsletterForm = document.getElementById('newsletter-form');
            if (newsletterForm) {
                newsletterForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const form = this;
                    const emailInput = form.querySelector('input[name="email"]');
                    const messageDiv = document.getElementById('newsletter-message');
                    const submitBtn = form.querySelector('button[type="submit"]');
                    
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                    
                    fetch('{{ route("newsletter.subscribe") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ email: emailInput.value })
                    })
                    .then(response => response.json())
                    .then(data => {
                        messageDiv.innerHTML = '<div class="text-' + (data.success ? 'success' : 'danger') + '">' + data.message + '</div>';
                        if (data.success) {
                            emailInput.value = '';
                        }
                    })
                    .catch(() => {
                        messageDiv.innerHTML = '<div class="text-danger">An error occurred. Please try again.</div>';
                    })
                    .finally(() => {
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Join';
                    });
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
