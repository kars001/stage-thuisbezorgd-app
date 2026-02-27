<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="form-group">
        <label for="email" class="form-label">{{ __('Email') }}</label>
        <input id="email" type="email" class="form-input @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
        <p class="form-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="password" class="form-label">{{ __('Password') }}</label>
        <input id="password" type="password" class="form-input @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">
        @error('password')
        <p class="form-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group flex items-center">
        <input class="form-checkbox mr-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label class="text-sm text-gray-600" for="remember">
            {{ __('Remember Me') }}
        </label>
    </div>

    <div class="auth-links mt-4 text-center">
        @if (Route::has('password.request'))
            <a class="text-sm text-primary-600 hover:text-primary-700 hover:underline" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif

        @if (Route::has('register'))
            <a class="text-sm text-primary-600 hover:text-primary-700 hover:underline mt-2" href="{{ route('register') }}">
                {{ __('Need an account? Register') }}
            </a>
        @endif
    </div>

    <div class="auth-actions">
        <button type="submit" class="btn btn-primary w-full">
            {{ __('Login') }}
        </button>
    </div>
</form>
