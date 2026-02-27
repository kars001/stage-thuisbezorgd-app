<?php

namespace Domain\Users\DataTransferObjects;

use Domain\Users\Models\User;

class UserIndexData
{
    public function __construct(
        public string $name,
        public string $email,
    ) {}

    public static function fromModel(User $user): self
    {
        return new self(
            name: $user->name,
            email: $user->email,
        );
    }
}
