<?php

namespace Domain\Users\QueryBuilders;

use Domain\Users\Collections\UserCollection;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Builder;

/**
 * @extends Builder<User>
 *
 * @method UserCollection get($columns = ['*'])
 */
class UserQueryBuilder extends Builder
{
    public function getByEmail(string $email): self
    {
        return $this->where('email', $email);
    }
}
