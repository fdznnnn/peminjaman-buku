<?php

namespace App\Filament\Resources\Loans\Tables;

use App\Models\Loan;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LoansTable
{
    public static function configure(Table $table): Table
    {
        $tableColumns = [
            TextColumn::make('user.name')
                ->label('Borrower')
                ->searchable()
                ->sortable(),

            TextColumn::make('book.title')
                ->label('Book')
                ->searchable()
                ->sortable(),

            TextColumn::make('loan_date')
                ->label('Loan Date')
                ->date()
                ->sortable(),

            TextColumn::make('due_date')
                ->label('Due Date')
                ->date()
                ->sortable(),

            TextColumn::make('returned_at')
                ->label('Returned Date')
                ->date()
                ->sortable(),

            TextColumn::make('status')
                ->label('Status')
                ->badge()
                ->color(fn (string $state): string => $state === 'dipinjam' ? 'warning' : 'success'),

            TextColumn::make('fine')
                ->label('Fine Fee')
                ->numeric()
                ->sortable(),

            TextColumn::make('created_at')
                ->label('Created At')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),

            TextColumn::make('updated_at')
                ->label('Updated At')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ];

        $rowActions = [
            Action::make('kembalikan')
                ->label('Return Book')
                ->icon('heroicon-o-arrow-uturn-left')
                ->requiresConfirmation()
                ->visible(fn (Loan $record): bool => $record->status === 'dipinjam')
                ->action(function (Loan $record): void {
                    $overdueDays = (int) $record->due_date->diffInDays(now()->startOfDay(), false);

                    $record->update([
                        'returned_at' => now(),
                        'status'      => 'dikembalikan',
                        'fine'        => max(0, $overdueDays) * 1000,
                    ]);

                    $record->book->increment('stock');

                    Notification::make()
                        ->title('Buku sudah dikembalikan')
                        ->success()
                        ->send();
                }),

            EditAction::make(),
        ];

        return $table
            ->columns($tableColumns)
            ->filters([
                //
            ])
            ->recordActions($rowActions)
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('loan_date', 'desc');
    }
}