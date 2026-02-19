
<style>
    .hoh-login-logo {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 16px rgba(30,64,175,0.15);
        margin: 0 auto 1.5rem auto;
    }
    .hoh-login-heading {
        color: #1e40af;
        font-weight: 800;
        text-align: center;
        font-size: 2.2rem;
        letter-spacing: -1px;
    }
    .hoh-login-subheading {
        color: #059669;
        text-align: center;
        margin-bottom: 1.5rem;
        font-size: 1.15rem;
        font-weight: 500;
    }
    .hoh-login-form {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 6px 32px rgba(30,64,175,0.10);
        padding: 2.5rem 2rem 2rem 2rem;
        max-width: 420px;
        margin: 0 auto;
        border: 1px solid #e5e7eb;
    }
    .hoh-form-group {
        position: relative;
        margin-bottom: 2rem;
    }
    .hoh-form-input {
        width: 100%;
        padding: 1.1rem 1rem 0.5rem 1rem;
        border: 1.5px solid #d1d5db;
        border-radius: 8px;
        background: #f8fafc;
        font-size: 1.08rem;
        transition: border 0.2s, box-shadow 0.2s;
        outline: none;
        box-shadow: none;
    }
    .hoh-form-input:focus {
        border-color: #1e40af;
        background: #fff;
        box-shadow: 0 0 0 2px #1e40af22;
    }
    .hoh-form-label {
        position: absolute;
        left: 1rem;
        top: 1.1rem;
        color: #64748b;
        font-size: 1rem;
        background: transparent;
        pointer-events: none;
        transition: all 0.18s cubic-bezier(.4,0,.2,1);
        padding: 0 0.2em;
    }
    .hoh-form-input:focus + .hoh-form-label,
    .hoh-form-input:not(:placeholder-shown) + .hoh-form-label {
        top: -0.7rem;
        left: 0.8rem;
        font-size: 0.92rem;
        color: #1e40af;
        background: #fff;
    }
    .hoh-login-btn {
        background: linear-gradient(90deg, #1e40af 60%, #059669 100%);
        border: none;
        color: #fff;
        font-weight: 700;
        font-size: 1.1rem;
        padding: 0.85rem 2.2rem;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(30,64,175,0.10);
        transition: background 0.2s, box-shadow 0.2s;
        margin-left: 0.5rem;
    }
    .hoh-login-btn:hover {
        background: linear-gradient(90deg, #059669 0%, #1e40af 100%);
        box-shadow: 0 4px 16px rgba(30,64,175,0.13);
    }
    .hoh-login-link {
        color: #dc2626;
        text-decoration: underline;
        font-weight: 500;
        font-size: 1rem;
    }
    .hoh-login-link:hover {
        color: #1e40af;
    }
    .hoh-remember {
        margin-bottom: 1.5rem;
    }
    .hoh-error {
        color: #dc2626;
        font-size: 0.98rem;
        margin-top: 0.3rem;
        margin-left: 0.2rem;
    }
</style>

<div>
    <div class="flex flex-col items-center mb-6">
        <div class="hoh-login-logo">
            <img src="/images/church-bg.png" alt="House of Hope Church Logo" style="width:60px;height:60px;border-radius:50%;">
        </div>
        <div class="hoh-login-heading">House of Hope Church Leeds</div>
        <div class="hoh-login-subheading">Admin Login</div>
    </div>
    <div class="hoh-login-form">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4 text-center" :status="session('status')" />
        <form method="POST" action="{{ route('login.store') }}" autocomplete="off">
            @csrf
            <div class="hoh-form-group">
                <input id="email" name="email" type="email" required autofocus autocomplete="email" placeholder=" " class="hoh-form-input" />
                <label for="email" class="hoh-form-label">Email address</label>
                @error('email')
                    <div class="hoh-error">{{ $message }}</div>
                @enderror
            </div>
            <div class="hoh-form-group">
                <input id="password" name="password" type="password" required autocomplete="current-password" placeholder=" " class="hoh-form-input" />
                <label for="password" class="hoh-form-label">Password</label>
                @error('password')
                    <div class="hoh-error">{{ $message }}</div>
                @enderror
            </div>
            <div class="hoh-remember flex items-center">
                <input id="remember" name="remember" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" />
                <label for="remember" class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</label>
            </div>
            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <a class="hoh-login-link" href="{{ route('password.request') }}" wire:navigate>
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                <button type="submit" class="hoh-login-btn">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>
    </div>
</div>
                                </a>
