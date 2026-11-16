<?php

namespace App\Filament\Resources\Loans\Pages;

use App\Filament\Resources\Loans\LoanResource;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditLoan extends EditRecord
{
    protected static string $resource = LoanResource::class;

    /**
     * Define header actions available on the edit loan page.
     */
    protected function getHeaderActions(): array
    {
        $actions = [
            DeleteAction::make()
                ->label('Delete Loan Record')
                ->requiresConfirmation(),
        ];

        return $actions;
    }

    /**
     * Customize the notification displayed upon successfully saving record updates.
     */
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Loan record updated successfully');
    }

    /**
     * Intercept and modify form data prior to persistence.
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        return parent::mutateFormDataBeforeSave($data);
    }
}