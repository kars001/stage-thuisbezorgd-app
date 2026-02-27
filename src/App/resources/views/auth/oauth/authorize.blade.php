@extends('auth.layout')

@section('content')
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">{{ __('Authorization Request') }}</h2>

    <div class="mb-6">
        <p class="text-gray-700 mb-2">
            <strong>{{ $client->name }}</strong> is requesting permission to access your account.
        </p>

        @if (count($scopes) > 0)
            <div class="mt-4">
                <p class="text-sm font-medium text-gray-700 mb-2">This application will be able to:</p>
                <ul class="list-disc pl-5 text-sm text-gray-600">
                    @foreach ($scopes as $scope)
                        <li>{{ $scope->description }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="flex space-x-4">
        <!-- Approve Button -->
        <form method="POST" action="{{ route('passport.authorizations.approve') }}" class="w-1/2">
            @csrf

            <input type="hidden" name="state" value="{{ $request->state }}">
            <input type="hidden" name="client_id" value="{{ $client->id }}">
            <input type="hidden" name="auth_token" value="{{ $authToken }}">

            <button type="submit" class="btn btn-primary w-full">
                {{ __('Authorize') }}
            </button>
        </form>

        <!-- Deny Button -->
        <form method="POST" action="{{ route('passport.authorizations.deny') }}" class="w-1/2">
            @csrf
            @method('DELETE')

            <input type="hidden" name="state" value="{{ $request->state }}">
            <input type="hidden" name="client_id" value="{{ $client->id }}">
            <input type="hidden" name="auth_token" value="{{ $authToken }}">

            <button type="submit" class="btn btn-secondary w-full">
                {{ __('Cancel') }}
            </button>
        </form>
    </div>
@endsection
