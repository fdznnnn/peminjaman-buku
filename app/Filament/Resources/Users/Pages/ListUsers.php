<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    /**
     * Get the actions available in the header of the list records page.
     */
    protected function getHeaderActions(): array
    {
        $headerListActions = [
            CreateAction::make()
                ->label('Create New User')
                ->icon('heroicon-o-user-plus'),
        ];

        return $headerListActions;
    }

    /**
     * Modify the table query for listing user records.
     */
    protected function getTableQuery(): ?Builder
    {
        return parent::getTableQuery();
    }
}
