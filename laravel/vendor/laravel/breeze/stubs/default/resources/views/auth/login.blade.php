
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
        margin: 0 auto 1rem auto;
    }
    .hoh-login-heading {
        color: #1e40af;
        font-weight: 700;
        text-align: center;
        font-size: 2rem;
    }
    .hoh-login-subheading {
        color: #059669;
        text-align: center;
        margin-bottom: 1rem;
        font-size: 1.1rem;
    }
    .hoh-login-form {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(30,64,175,0.08);
        padding: 2rem 1.5rem;
        max-width: 420px;
        margin: 0 auto;
    }
    .hoh-login-btn {
        background: #1e40af;
        border-color: #1e40af;
        color: #fff;
        font-weight: 600;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        transition: background 0.2s;
    }
    .hoh-login-btn:hover {
        background: #059669;
        border-color: #059669;
    }
    .hoh-login-link {
        color: #dc2626;
        text-decoration: underline;
        font-weight: 500;
    }
    .hoh-login-link:hover {
        color: #1e40af;
    }
</style>

<x-guest-layout>
    <div class="flex flex-col items-center mb-6">
        <div class="hoh-login-logo">
            <img src="/images/church-bg.png" alt="House of Hope Church Logo" style="width:60px;height:60px;border-radius:50%;">
        </div>
        <div class="hoh-login-heading">House of Hope Church Leeds</div>
        <div class="hoh-login-subheading">Admin Login</div>
    </div>
    <div class="hoh-login-form">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="hoh-login-link" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <button type="submit" class="hoh-login-btn ms-3">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
