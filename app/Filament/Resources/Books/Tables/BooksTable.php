<?php

namespace App\Filament\Resources\Books\Tables;

use App\Models\Book;
use App\Models\Loan;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BooksTable
{
    public static function configure(Table $table): Table
    {
        $columns = [
            TextColumn::make('title')
                ->label('Title')
                ->searchable()
                ->sortable(),

            TextColumn::make('author')
                ->label('Author')
                ->searchable()
                ->sortable(),

            TextColumn::make('publisher')
                ->label('Publisher')
                ->searchable(),

            TextColumn::make('year')
                ->label('Year')
                ->numeric()
                ->sortable(),

            TextColumn::make('stock')
                ->label('Stock')
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

        $recordActions = [
            Action::make('pinjam')
                ->label('Borrow Book')
                ->icon('heroicon-o-book-open')
                ->requiresConfirmation()
                ->visible(fn (): bool => ! auth()->user()->isAdmin())
                ->disabled(fn (Book $record): bool => $record->stock < 1)
                ->action(function (Book $record): void {
                    $activeLoanTotal = Loan::query()
                        ->where('user_id', auth()->id())
                        ->where('status', 'dipinjam')
                        ->count();

                    if ($activeLoanTotal >= 3) {
                        Notification::make()
                            ->title('Maksimal pinjam 3 buku')
                            ->danger()
                            ->send();
                        return;
                    }

                    Loan::create([
                        'user_id'   => auth()->id(),
                        'book_id'   => $record->id,
                        'loan_date' => now(),
                        'due_date'  => now()->addDays(7),
                    ]);

                    $record->decrement('stock');

                    Notification::make()
                        ->title('Buku berhasil dipinjam')
                        ->success()
                        ->send();
                }),

            EditAction::make(),
        ];

        return $table
            ->columns($columns)
            ->filters([
                //
            ])
            ->recordActions($recordActions)
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('title', 'asc');
    }
}