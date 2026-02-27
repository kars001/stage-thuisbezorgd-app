@extends('auth.layout')

@section('content')
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">{{ __('Reset Password') }}</h2>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" type="email" class="form-input @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth-actions">
            <button type="submit" class="btn btn-primary w-full">
                {{ __('Email Password Reset Link') }}
            </button>
        </div>

        <div class="auth-links mt-4 text-center">
            <a class="text-sm text-primary-600 hover:text-primary-700 hover:underline" href="{{ route('login') }}">
                {{ __('Back to Login') }}
            </a>
        </div>
    </form>
@endsection
