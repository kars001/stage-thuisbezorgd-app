<?php

namespace Support\Authentication\Actions\Socialite;

use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse as SymfonyRedirectResponse;

class SocialiteRedirectAction
{
    public function execute(
        string $provider
    ): SymfonyRedirectResponse|RedirectResponse {
        return Socialite::driver($provider)->redirect();
    }
}
