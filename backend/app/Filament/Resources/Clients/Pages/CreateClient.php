<?php

namespace App\Filament\Resources\Clients\Pages;

use App\Filament\Resources\Clients\ClientResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreateClient extends CreateRecord
{
    protected static string $resource = ClientResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
//        dd($data);
        // Create user first
        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'full_name' => $data['full_name'],
            'gender' => $data['gender'],
        ]);

        // Set user_id for client
        $data['user_id'] = $user->id;

        // Remove user data from client data
        unset($data['user']);

        // Create client record
        return static::getModel()::create($data);
    }
}
