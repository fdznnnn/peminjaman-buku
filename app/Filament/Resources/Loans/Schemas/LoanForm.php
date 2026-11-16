<?php

namespace App\Filament\Resources\Loans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LoanForm
{
    /**
     * Configure the schema components for the loan resource form.
     */
    public static function configure(Schema $schema): Schema
    {
        $formFields = [
            Select::make('user_id')
                ->label('Borrower Name')
                ->relationship('user', 'name')
                ->searchable()
                ->preload()
                ->required(),

            Select::make('book_id')
                ->label('Book Item')
                ->relationship('book', 'title')
                ->searchable()
                ->preload()
                ->required(),

            DatePicker::make('loan_date')
                ->label('Loan Date')
                ->native(false)
                ->required(),

            DatePicker::make('due_date')
                ->label('Due Date')
                ->native(false)
                ->required(),

            DatePicker::make('returned_at')
                ->label('Return Date')
                ->native(false),

            TextInput::make('status')
                ->label('Loan Status')
                ->required()
                ->default('dipinjam'),

            TextInput::make('fine')
                ->label('Fine Amount')
                ->numeric()
                ->default(0)
                ->prefix('$')
                ->required(),
        ];

        return $schema->components($formFields);
    }
}