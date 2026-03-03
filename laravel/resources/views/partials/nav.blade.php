<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top" role="navigation" aria-label="Main navigation">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('Logo.png') }}" alt="" class="logo" style="height:32px; width:auto;" aria-hidden="true">
            <span class="ms-2">House of Hope Church Leeds</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link @if(request()->is('/')) active @endif" href="{{ url('/') }}" @if(request()->is('/')) aria-current="page" @endif>Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->is('about')) active @endif" href="{{ url('/about') }}">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle @if(request()->is('sermons*') || request()->is('reflections*')) active @endif" href="#" id="teachingsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Teachings
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="teachingsDropdown">
                        <li><a class="dropdown-item" href="{{ url('/sermons') }}">Sermons</a></li>
                        <li><a class="dropdown-item" href="{{ url('/reflections') }}">Reflections</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->is('ministries')) active @endif" href="{{ url('/ministries') }}">Ministries</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->is('events*')) active @endif" href="{{ url('/events') }}">Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->is('dreams*')) active @endif" href="{{ url('/dreams') }}">Revelations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->is('contact')) active @endif" href="{{ url('/contact') }}">Contact</a>
                </li>
                <li class="nav-item ms-lg-2">
                    <a class="btn btn-primary btn-sm" href="{{ url('/donate') }}">Give</a>
                </li>
            </ul>
            <hr class="d-lg-none border-secondary my-2">
            <div class="d-flex align-items-center ms-lg-3">
                <button 
                    id="theme-toggle" 
                    type="button" 
                    class="btn btn-link text-light p-2" 
                    aria-label="Switch to dark mode"
                    aria-pressed="false"
                    title="Toggle dark mode"
                >
                    <i class="fas fa-moon dark-icon" aria-hidden="true"></i>
                    <i class="fas fa-sun light-icon d-none" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
</nav>
