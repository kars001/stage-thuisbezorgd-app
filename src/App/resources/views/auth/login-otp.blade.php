<form method="POST" action="{{ route('login.store') }}">
    @csrf

    <div class="form-group">
        <label for="email" class="form-label">{{ __('Email') }}</label>
        <input id="email" type="email" class="form-input @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
        <p class="form-error">{{ $message }}</p>
        @enderror
    </div>

    @if ($password_required)
        <div class="form-group">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-input @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">
            @error('password')
            <p class="form-error">{{ $message }}</p>
            @enderror
        </div>
    @endif

    <div class="auth-actions">
        <button type="submit" class="btn btn-primary w-full">
            {{ __('Send code') }}
        </button>
    </div>
</form>
