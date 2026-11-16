<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    /**
     * Configure the table schema for the user resource.
     */
    public static function configure(Table $table): Table
    {
        $userColumns = [
            TextColumn::make('name')
                ->label('User Name')
                ->searchable()
                ->sortable(),

            TextColumn::make('email')
                ->label('Email Address')
                ->searchable()
                ->sortable(),

            TextColumn::make('role')
                ->label('Role')
                ->badge()
                ->color(fn (string $state): string => $state === 'admin' ? 'success' : 'info')
                ->searchable()
                ->sortable(),

            TextColumn::make('kelas')
                ->label('Class Room')
                ->searchable()
                ->sortable(),

            TextColumn::make('email_verified_at')
                ->label('Verified At')
                ->dateTime()
                ->sortable(),

            TextColumn::make('created_at')
                ->label('Joined Date')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),

            TextColumn::make('updated_at')
                ->label('Last Updated')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ];

        $userActions = [
            EditAction::make()
                ->label('Edit Profile'),
        ];

        return $table
            ->columns($userColumns)
            ->filters([
                //
            ])
            ->recordActions($userActions)
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('name', 'asc');
    }
}