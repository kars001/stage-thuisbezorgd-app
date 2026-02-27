@extends('auth.layout')

@section('content')
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">{{ __('Reset Password') }}</h2>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="form-group">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" type="email" class="form-input @error('email') border-red-500 @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-input @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">
            @error('password')
            <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="form-input" name="password_confirmation" required autocomplete="new-password">
        </div>

        <div class="auth-actions">
            <button type="submit" class="btn btn-primary w-full">
                {{ __('Reset Password') }}
            </button>
        </div>
    </form>
@endsection
