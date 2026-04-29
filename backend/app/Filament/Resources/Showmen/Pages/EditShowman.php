<?php

namespace App\Filament\Resources\Showmen\Pages;

use App\Filament\Resources\Showmen\ShowmanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditShowman extends EditRecord
{
    protected static string $resource = ShowmanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function mount($record): void
    {
        parent::mount($record);
        
        // Load record with user relationship
        $this->record = \App\Models\Showman::with('user')->find($record);
        
        // Fill all form data
        $this->form->fill([
            'first_name' => $this->record?->first_name,
            'last_name' => $this->record?->last_name,
            'gender' => $this->record?->gender,
            'bio' => $this->record?->bio,
            'user' => [
                'email' => $this->record?->user?->email,
                'role_id' => $this->record?->user?->role_id,
            ],
        ]);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Update user role if provided
        if (isset($data['user']['role_id'])) {
            $this->record->user->update(['role_id' => $data['user']['role_id']]);
        }

        // Update user email only if it has changed and doesn't already exist
        if (isset($data['user']['email']) && $data['user']['email'] !== $this->record->user->email) {
            $existingUser = \App\Models\User::where('email', $data['user']['email'])->first();
            if ($existingUser) {
                \Filament\Notifications\Notification::make()
                    ->title('Error')
                    ->body('Email already exists: ' . $data['user']['email'])
                    ->danger()
                    ->send();
                $this->halt();
            }
            $this->record->user->update(['email' => $data['user']['email']]);
        }

        // Remove user data from showman data
        unset($data['user']);

        return $data;
    }
}
