<?php

namespace App\Filament\Resources\Loans\Pages;

use App\Filament\Resources\Loans\LoanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListLoans extends ListRecords
{
    protected static string $resource = LoanResource::class;

    /**
     * Get the header actions available on the list records page.
     */
    protected function getHeaderActions(): array
    {
        $headerActions = [
            CreateAction::make()
                ->label('New Loan')
                ->icon('heroicon-o-plus'),
        ];

        return $headerActions;
    }

    /**
     * Modify the table query for listing loans.
     */
    protected function getTableQuery(): ?Builder
    {
        return parent::getTableQuery();
    }
}