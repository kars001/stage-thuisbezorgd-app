<?php

namespace Tests\Unit\Domains\User;

use Database\Factories\Domain\Users\UserUpsertDataFactory;
use Domain\Users\Actions\CreateUserAction;
use Domain\Users\Actions\UpdateUserAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_user_action_creates_user_and_hashes_password(): void
    {
        $dto = UserUpsertDataFactory::new()
            ->withName('John Doe')
            ->withEmail('johndoe@email.com')
            ->withPassword('secret123')
            ->create();

        $action = app(CreateUserAction::class);
        $user = $action->execute($dto);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'John Doe',
            'email' => 'johndoe@email.com',
        ]);

        $this->assertTrue(Hash::check('secret123', $user->password), 'Password should be hashed and verifiable');
    }

    public function test_update_user_action_updates_without_changing_password_when_password_is_null(): void
    {
        $dto = UserUpsertDataFactory::new()
            ->withName('Initial Name')
            ->withEmail('initial@example.test')
            ->withPassword('old-password')
            ->create();

        $action = app(CreateUserAction::class);
        $user = $action->execute($dto);

        $oldPasswordHash = $user->password;

        $dto = UserUpsertDataFactory::new()
            ->withName('Jane Smith')
            ->withEmail('jane@example.test')
            ->create();

        $action = app(UpdateUserAction::class);
        $updated = $action->execute($user, $dto);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Jane Smith',
            'email' => 'jane@example.test',
        ]);
        $this->assertSame($oldPasswordHash, $updated->password, 'Password hash should remain unchanged');
    }

    public function test_update_user_action_updates_password_when_provided(): void
    {
        $dto = UserUpsertDataFactory::new()
            ->withName('Initial Name')
            ->withEmail('initial@example.test')
            ->withPassword('old-password')
            ->create();

        $action = app(CreateUserAction::class);
        $user = $action->execute($dto);

        $oldPasswordHash = $user->password;

        $dto = UserUpsertDataFactory::new()
            ->withName('Jane Smith')
            ->withEmail('jane@example.test')
            ->withPassword('new-password-123')
            ->create();

        $action = app(UpdateUserAction::class);
        $updated = $action->execute($user, $dto);

        $this->assertNotSame($oldPasswordHash, $updated->password, 'Password hash should change');
        $this->assertTrue(Hash::check('new-password-123', $updated->password), 'New password should be set and hashed');
    }
}
