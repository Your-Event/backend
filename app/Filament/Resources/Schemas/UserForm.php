<?php

namespace App\Filament\Resources\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->password()
                    ->required(),
                TextInput::make('user_type')
                    ->required(),
                Select::make('role_id')
                    ->relationship('role', 'title'),
                TextInput::make('full_name'),
                TextInput::make('gender'),
                FileUpload::make('image_path')
                    ->image(),
                FileUpload::make('wall_image_path')
                    ->image(),
                TextInput::make('bio'),
            ]);
    }
}
