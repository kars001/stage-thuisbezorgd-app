<?php

namespace App\Admin\User\Controllers;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\RedirectResponse;
use Support\Authentication\Actions\Socialite\SocialiteCallbackAction;
use Support\Authentication\Actions\Socialite\SocialiteRedirectAction;
use Symfony\Component\HttpFoundation\RedirectResponse as SymfonyRedirectResponse;

class SocialiteController
{
    public function redirect(string $provider, SocialiteRedirectAction $action): SymfonyRedirectResponse|RedirectResponse
    {
        return $action->execute($provider);
    }

    /**
     * @throws AuthenticationException
     */
    public function callback(string $provider, SocialiteCallbackAction $action): SymfonyRedirectResponse|RedirectResponse
    {
        return $action->execute($provider);
    }
}
