<?php

namespace App\Filament\Resources\UserRoles\Schemas;

use App\Models\UserType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserRoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('userTypes')
                    ->label('User Types')
                    ->relationship('userTypes', 'name')
                    ->preload()
                    ->required()
                    ->native(false),
                TextInput::make('title')
                    ->label('Role name')
                    ->required(),
            ]);
    }
}
