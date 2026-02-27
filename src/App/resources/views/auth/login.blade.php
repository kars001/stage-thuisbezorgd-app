@extends('auth.layout')

@section('content')
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">{{ __('Login') }}</h2>

    @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @include($login_form_view)

    {{-- Display SSO options if enabled --}}
    @if($sso_enabled)
        @include('auth.login-sso')
    @endif

@endsection
