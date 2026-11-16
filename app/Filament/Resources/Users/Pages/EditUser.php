<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    /**
     * Configure header actions for the edit user page.
     */
    protected function getHeaderActions(): array
    {
        $actions = [
            DeleteAction::make()
                ->label('Delete User Account')
                ->requiresConfirmation(),
        ];

        return $actions;
    }

    /**
     * Customize notification upon saving changes.
     */
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('User details updated successfully');
    }

    /**
     * Hook before saving form data.
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        return parent::mutateFormDataBeforeSave($data);
    }
}