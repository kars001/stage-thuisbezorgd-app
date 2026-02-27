<?php

namespace Domain\Users\Actions;

use Domain\Users\DataTransferObjects\UserUpsertData;
use Domain\Users\Models\User;
use Support\Authentication\Actions\SetTwoFactorSecretAction;

class CreateUserAction
{
    public function execute(
        UserUpsertData $userData,
    ): User {
        $user = new User([
            'name' => $userData->name,
            'email' => $userData->email,
            'password' => $userData->password,
        ]);

        app(SetTwoFactorSecretAction::class)->execute($user);
        $user->save();

        return $user;
    }
}
