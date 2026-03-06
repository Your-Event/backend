<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

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

                TextInput::make('password')
                    ->password()
                    ->required(fn (string $operation) => $operation === 'create')
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                    ->dehydrated(fn ($state) => filled($state)),

                Select::make('user_type_id')
                    ->label('User Type')
                    ->relationship('userType', 'name')
                    ->preload()
                    ->reactive()
                    ->required()
                    ->native(false),

                Select::make('role_id')
                    ->label('Role')
                    ->options(function (callable $get) {
                        $userTypeId = $get('user_type_id');

                        if (!$userTypeId) {
                            return [];
                        }

                        return Role::whereHas('userTypes', function ($q) use ($userTypeId) {
                            $q->where('user_types.id', $userTypeId);
                        })->pluck('title', 'id');
                    })
                    ->native(false)
                    ->searchable(),

                TextInput::make('full_name'),
                Select::make('gender')
                ->options([
                    'male' => 'Male',
                    'female' => 'Female',
                ])
                ->native(false),

                FileUpload::make('image_path')
                    ->image(),

                FileUpload::make('wall_image_path')
                    ->image(),

                TextInput::make('bio'),

                Repeater::make('phones')
                    ->label('Phone Numbers')
                    ->relationship()
                    ->schema([
                        TextInput::make('phone')
                            ->label('Phone Number')
                            ->tel()
                            ->required(),
                        TextInput::make('last_used_code')
                            ->label('Last Used Code'),
                        TimePicker::make('shift_start')
                            ->label('Shift Start')
                            ->seconds(false)
                            ->native(false)
                            ->format('H:i')
                            ->displayFormat('H:i')
                            ->suffixIcon('heroicon-o-clock'),
                        TimePicker::make('shift_end')
                            ->label('Shift End')
                            ->seconds(false)
                            ->native(false)
                            ->format('H:i')
                            ->displayFormat('H:i'),
                    ])
                    ->collapsible()
                    ->itemLabel(fn (array $state): ?string => $state['phone'] ?? null)
                    ->addActionLabel('Add Phone'),
            ]);
    }
}
