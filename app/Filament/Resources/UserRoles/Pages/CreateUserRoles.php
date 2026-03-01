<?php

namespace App\Filament\Resources\UserRoles\Pages;

use App\Filament\Resources\UserRoles\UserRoleResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUserRoles extends CreateRecord
{
    protected static string $resource = UserRoleResource::class;

    protected function getRedirectUrl(): string
    {
        return UserRoleResource::getUrl('index');
    }
}
