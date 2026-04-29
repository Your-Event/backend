<?php

namespace App\Filament\Resources\Clients\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->default(fn ($record) => $record?->user?->email),

                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required(fn (string $operation) => $operation === 'create'),

                TextInput::make('full_name')
                    ->label('First Name')
                    ->required()
                    ->default(fn ($record) => $record?->first_name),

                Select::make('gender')
                    ->label('Gender')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                    ])
                    ->required()
                    ->native(false)
                    ->default(fn ($record) => $record?->gender),
            ]);
    }
}
