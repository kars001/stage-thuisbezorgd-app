@extends('auth.layout')

@section('content')
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">{{ __('Two Factor Authentication') }}</h2>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application or one of your recovery codes.') }}
    </div>

    <form method="POST" action="{{ route('two-factor.login') }}" id="2fa-form">
        @csrf

        <div class="form-group" x-data="{ recovery: false }" x-cloak>
            <div x-show="!recovery">
                <label for="code" class="form-label">{{ __('Authentication Code') }}</label>
                <input id="code" type="text" inputmode="numeric" class="form-input @error('code') border-red-500 @enderror" name="code" autofocus x-ref="code" autocomplete="one-time-code">
                @error('code')
                <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            @if($uses_authenticator)
                <div x-show="recovery">
                    <label for="recovery_code" class="form-label">{{ __('Recovery Code') }}</label>
                    <input id="recovery_code" type="text" class="form-input @error('recovery_code') border-red-500 @enderror" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code">
                    @error('recovery_code')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            @endif
        </div>

        <div class="auth-actions">
            <button type="submit" class="btn btn-primary w-full">
                {{ __('Login') }}
            </button>
        </div>

        <div class="auth-links mt-4 text-center">
            <button type="button" class="text-sm text-primary-600 hover:text-primary-700 hover:underline" x-data="{ recovery: false }"
                    x-on:click="
                    recovery = !recovery;
                    $nextTick(() => {
                        if (recovery) {
                            $refs.recovery_code.focus();
                            $refs.recovery_code.select();
                            document.getElementById('2fa-form').action = '{{ route('two-factor.login') }}?recovery=true';
                        } else {
                            $refs.code.focus();
                            $refs.code.select();
                            document.getElementById('2fa-form').action = '{{ route('two-factor.login') }}';
                        }
                    })
                ">
                @if($uses_authenticator)
                    <span x-show="!recovery">{{ __('Use a recovery code') }}</span>
                @endif
                <span x-show="recovery">{{ __('Use an authentication code') }}</span>
            </button>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('twoFactor', () => ({
                recovery: false,
                toggleRecovery() {
                    this.recovery = !this.recovery;

                    this.$nextTick(() => {
                        if (this.recovery) {
                            this.$refs.recoveryCode.focus();
                        } else {
                            this.$refs.code.focus();
                        }
                    });
                }
            }));
        });
    </script>
@endpush
