<?php

namespace App\Filament\Resources\UserRoles\Pages;

use App\Filament\Resources\UserRoles\UserRoleResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUserRoles extends EditRecord
{
    protected static string $resource = UserRoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return UserRoleResource::getUrl('index');
    }
}
