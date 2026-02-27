<?php

namespace Domain\Users\Policies;

use Domain\Users\Models\User;

class UserPolicy
{
    public function delete(User $user, User $record): bool
    {
        return $user->id !== $record->id;
    }
}
