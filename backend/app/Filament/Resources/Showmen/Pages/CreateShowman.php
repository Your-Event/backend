<?php

namespace App\Filament\Resources\Showmen\Pages;

use App\Filament\Resources\Showmen\ShowmanResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreateShowman extends CreateRecord
{
    protected static string $resource = ShowmanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        // Create user first
        $user = User::create([
            'email' => $data['user']['email'],
            'password' => Hash::make($data['user']['password']),
            'role_id' => $data['user']['role_id'] ?? null,
        ]);

        // Set user_id for showman
        $data['user_id'] = $user->id;

        // Remove user data from showman data
        unset($data['user']);

        // Create showman record
        return static::getModel()::create($data);
    }
}
