<?php

namespace App\Filament\Resources\Showmen;

use App\Filament\Resources\Showmen\Pages\CreateShowman;
use App\Filament\Resources\Showmen\Pages\EditShowman;
use App\Filament\Resources\Showmen\Pages\ListShowmen;
use App\Filament\Resources\Showmen\Schemas\ShowmanForm;
use App\Filament\Resources\Showmen\Tables\ShowmenTable;
use App\Models\Showman;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ShowmanResource extends Resource
{
    protected static ?string $model = Showman::class;

    protected static ?string $navigationLabel = 'Showmen';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Microphone;

    public static function form(Schema $schema): Schema
    {
        return ShowmanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ShowmenTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListShowmen::route('/'),
            'create' => CreateShowman::route('/create'),
            'edit' => EditShowman::route('/{record}/edit'),
        ];
    }
}
