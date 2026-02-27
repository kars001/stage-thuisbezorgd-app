<?php

namespace Domain\Users\DataTransferObjects;

class UserUpsertData
{
    public function __construct(
        public string $name,
        public string $email,
        public ?string $password = null,
    ) {}

    /**
     * @return array<string, string|null>
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
