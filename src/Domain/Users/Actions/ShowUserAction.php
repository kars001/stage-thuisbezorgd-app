<?php

namespace Domain\Users\Actions;

use Domain\Users\Models\User;

class ShowUserAction
{
    public function execute(User $user): User
    {
        return $user;
    }
}
