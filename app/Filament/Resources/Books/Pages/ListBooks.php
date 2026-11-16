<?php

namespace App\Filament\Resources\Books\Pages;

use App\Filament\Resources\Books\BookResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListBooks extends ListRecords
{
    protected static string $resource = BookResource::class;

    /**
     * Configure the actions that should be displayed in the page header.
     */
    protected function getHeaderActions(): array
    {
        $headerActions = [
            CreateAction::make()
                ->label('New Book')
                ->icon('heroicon-o-plus-circle'),
        ];

        return $headerActions;
    }

    /**
     * Modify the base table query if needed.
     */
    protected function getTableQuery(): ?Builder
    {
        return parent::getTableQuery();
    }
}