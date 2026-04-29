<?php

namespace App\Filament\Resources\Showmen\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use App\Models\Role;

class ShowmenTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('first_name')
                    ->label('First Name')
                    ->searchable(),
                TextColumn::make('last_name')
                    ->label('Last Name')
                    ->searchable(),
                TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('user.role.title')
                    ->label('Role')
                    ->badge()
                    ->searchable()
                    ->default('No Role'),
                TextColumn::make('gender')
                    ->label('Gender')
                    ->searchable(),
                TextColumn::make('bio')
                    ->label('Biography')
                    ->searchable()
                    ->limit(50),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->label('Role')
                    ->options(Role::pluck('title', 'id'))
                    ->query(function ($query, $data) {
                        if (!empty($data['value'])) {
                            $query->whereHas('user', function ($q) use ($data) {
                                $q->where('role_id', $data['value']);
                            });
                        }
                    }),
            ])
            ->toolbarActions([
                CreateAction::make(),
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
