<?php

namespace App\Filament\Resources\Showmen\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use App\Models\Role;

class ShowmanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('first_name')
                    ->label('First Name')
                    ->required()
                    ->default(fn ($record) => $record?->first_name),

                TextInput::make('last_name')
                    ->label('Last Name')
                    ->required()
                    ->default(fn ($record) => $record?->last_name),

                Select::make('gender')
                    ->label('Gender')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                    ])
                    ->required()
                    ->default(fn ($record) => $record?->gender),

                Select::make('user.role_id')
                    ->label('Role')
                    ->options(Role::pluck('title', 'id'))
                    ->searchable()
                    ->required()
                    ->native(false)
                    ->default(fn ($record) => $record?->user?->role_id),

                TextInput::make('user.email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->default(fn ($record) => $record?->user?->email),

                TextInput::make('user.password')
                    ->label('Password')
                    ->password()
                    ->required(fn (string $operation) => $operation === 'create'),

                Textarea::make('bio')
                    ->label('Biography')
                    ->rows(3)
                    ->default(fn ($record) => $record?->bio),
            ]);
    }
}
