<?php

namespace App\Filament\Resources\Companies\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CompanyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Company Name')
                    ->required()
                    ->default(fn ($record) => $record?->name),

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
                    ->label('Description')
                    ->rows(3)
                    ->default(fn ($record) => $record?->bio),
            ]);
    }
}
