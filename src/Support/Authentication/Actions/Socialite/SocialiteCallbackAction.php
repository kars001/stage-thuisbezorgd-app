<?php

namespace Support\Authentication\Actions\Socialite;

use Domain\Users\Models\SocialLogin;
use Domain\Users\Models\User as UserModel;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Contracts\User;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse as SymfonyRedirectResponse;

class SocialiteCallbackAction
{
    /**
     * @throws AuthenticationException
     */
    public function execute(
        string $provider
    ): SymfonyRedirectResponse|RedirectResponse {
        /** @var User&object{token: string} $socialUser */
        $socialUser = Socialite::driver($provider)->user();

        /** @var ?UserModel $existingUser */
        $existingUser = Auth::user()?->query()->firstWhere('email', $socialUser->getEmail());

        if (! $existingUser) {
            throw new AuthenticationException('User needs to be registered before login');
        }

        /**
         * @var SocialLogin $socialLogin
         */
        $socialLogin = $existingUser->socialLogins()->firstOrNew(['provider_name' => $provider]);
        $socialLogin->provider_id = $socialUser->getId();
        $socialLogin->provider_token = $socialUser->token;
        $socialLogin->save();

        Auth::login($existingUser);

        return redirect()->intended(route('filament.admin.pages.dashboard'));

    }
}
