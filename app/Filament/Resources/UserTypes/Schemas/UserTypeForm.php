<?php

namespace App\Filament\Resources\UserTypes\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Name user type')
                    ->unique(
                        table: 'user_types',
                        column: 'name',
                        ignoreRecord: true
                    )
                    ->validationMessages([
                        'unique' => 'This user type already exists.',
                    ])
                    ->required(),
            ]);
    }
}
