<?php

namespace Domain\Users\Actions;

use Domain\Users\DataTransferObjects\UserIndexData;
use Domain\Users\Models\User;
use Illuminate\Support\Collection;

class IndexUserAction
{
    /**
     * @return Collection<int|string, UserIndexData>
     */
    public function execute(): Collection
    {
        return User::query()->get()->map(fn (User $user) => UserIndexData::fromModel($user));
    }
}
