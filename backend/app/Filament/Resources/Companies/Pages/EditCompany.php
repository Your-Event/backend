<?php

namespace App\Filament\Resources\Companies\Pages;

use App\Filament\Resources\Companies\CompanyResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCompany extends EditRecord
{
    protected static string $resource = CompanyResource::class;

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
        
        // Explicitly load the record with user relationship
        $this->record = \App\Models\Company::with('user')->find($record);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Update user email only if it has changed
        if (isset($data['user']['email']) && $data['user']['email'] !== $this->record->user->email) {
            $this->record->user->update(['email' => $data['user']['email']]);
        }

        // Remove user data from company data
        unset($data['user']);

        return $data;
    }
}
