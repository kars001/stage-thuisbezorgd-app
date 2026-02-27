<?php

namespace App\Admin\User\Filament\Resources\User\Pages;

use App\Admin\User\Filament\Resources\User\UserResource;
use Domain\Users\Actions\UpdateUserAction;
use Domain\Users\DataTransferObjects\UserUpsertData;
use Domain\Users\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    /**
     * @param  User  $record
     */
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $userData = new UserUpsertData(...$data);

        app(UpdateUserAction::class)->execute($record, $userData);

        return $record->refresh();
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
