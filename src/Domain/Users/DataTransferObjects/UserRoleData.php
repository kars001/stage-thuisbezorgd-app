<?php

namespace Domain\Users\DataTransferObjects;

class UserRoleData
{
    public function __construct(
        public string $name,
    ) {}
}
