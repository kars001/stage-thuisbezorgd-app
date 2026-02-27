<?php

namespace Domain\Users\Actions;

use Domain\Users\DataTransferObjects\UserUpsertData;
use Domain\Users\Models\User;

class UpdateUserAction
{
    public function execute(
        User $user,
        UserUpsertData $userData,
    ): User {
        $data = $userData->toArray();

        if (! $userData->password) {
            unset($data['password']);
        }

        $user->update($data);

        return $user;
    }
}
