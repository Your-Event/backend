<?php

namespace App\Filament\Resources\Companies\Pages;

use App\Filament\Resources\Companies\CompanyResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreateCompany extends CreateRecord
{
    protected static string $resource = CompanyResource::class;

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
        ]);

        // Set user_id for company
        $data['user_id'] = $user->id;

        // Remove user data from company data
        unset($data['user']);

        // Create company record
        return static::getModel()::create($data);
    }
}
