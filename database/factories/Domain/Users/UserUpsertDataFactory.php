<?php

namespace Database\Factories\Domain\Users;

use Domain\Users\DataTransferObjects\UserUpsertData;

class UserUpsertDataFactory
{
    private ?string $email = null;
    private ?string $name = null;
    private ?string $password = null;

    public static function new(): self
    {
        return new self();
    }

    public function create(): UserUpsertData
    {
       $data = new UserUpsertData(
           name: $this->name ?? fake()->name,
           email: $this->email ?? fake()->email,
       );

       if ($this->password) {
           $data->password = $this->password;
       }

       return $data;
    }

    public function withName(string $name): self
    {
        $clone = clone $this;

        $clone->name = $name;

        return $clone;
    }

    public function withEmail(string $email): self
    {
        $clone = clone $this;

        $clone->email = $email;

        return $clone;
    }

    public function withPassword(string $password = null): self
    {
        $clone = clone $this;

        $clone->password = $password ?? fake()->password;

        return $clone;
    }
}
