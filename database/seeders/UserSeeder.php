<?php

namespace Database\Seeders;

use Domain\Users\Actions\CreateUserAction;
use Domain\Users\DataTransferObjects\UserUpsertData;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app(CreateUserAction::class)->execute(
            new UserUpsertData(...[
                'name' => 'Hatch',
                'email' => 'info@hatch.digital',
                'password' => '1234',
            ])
        );
    }
}
