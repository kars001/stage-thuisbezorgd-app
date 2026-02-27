<?php

namespace App\Admin\User\Filament\Resources\User\Pages;

use App\Admin\User\Filament\Resources\User\UserResource;
use Domain\Users\Actions\CreateUserAction;
use Domain\Users\DataTransferObjects\UserUpsertData;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $userData = new UserUpsertData(...$data);

        return app(CreateUserAction::class)->execute($userData);
    }
}
