<?php

namespace App\Filament\Resources\Books\Pages;

use App\Filament\Resources\Books\BookResource;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditBook extends EditRecord
{
    protected static string $resource = BookResource::class;

    /**
     * Configure the header actions available on the edit page.
     */
    protected function getHeaderActions(): array
    {
        $actions = [
            DeleteAction::make(),
        ];

        return $actions;
    }

    /**
     * Customize the success notification upon saving updates.
     */
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Book updated successfully');
    }

    /**
     * Intercept and return form data before saving.
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        return parent::mutateFormDataBeforeSave($data);
    }
}