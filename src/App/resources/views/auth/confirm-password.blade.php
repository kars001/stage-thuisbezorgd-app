@extends('auth.layout')

@section('content')
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">{{ __('Confirm Password') }}</h2>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="form-group">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-input @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">
            @error('password')
            <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth-actions">
            <button type="submit" class="btn btn-primary w-full">
                {{ __('Confirm Password') }}
            </button>
        </div>

        <div class="auth-links mt-4 text-center">
            @if (Route::has('password.request'))
                <a class="text-sm text-primary-600 hover:text-primary-700 hover:underline" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </div>
    </form>
@endsection
