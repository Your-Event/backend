<?php

namespace App\Filament\Resources\Clients\Pages;

use App\Filament\Resources\Clients\ClientResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditClient extends EditRecord
{
    protected static string $resource = ClientResource::class;

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

        $this->record = \App\Models\Client::with('user')->find($record);
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if ($this->record && $this->record->user) {
            $data['user'] = [
                'email' => $this->record->user->email,
            ];
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Update user email only if it has changed
        if (isset($data['user']['email']) && $data['user']['email'] !== $this->record->user->email) {
            $this->record->user->update(['email' => $data['user']['email']]);
        }

        unset($data['user']);

        return $data;
    }
}
