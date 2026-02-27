<div class="mt-6">
    <div class="relative">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-300"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-2 bg-white text-gray-500">{{ __('Or continue with') }}</span>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 gap-3">
        @include('auth.socialite.google')
    </div>
</div>
