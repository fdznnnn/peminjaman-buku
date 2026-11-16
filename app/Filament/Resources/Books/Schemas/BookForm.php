<?php

namespace App\Filament\Resources\Books\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BookForm
{
    /**
     * Configure the schema components for the book resource form.
     */
    public static function configure(Schema $schema): Schema
    {
        $fields = [
            TextInput::make('title')
                ->label('Title')
                ->placeholder('Enter book title')
                ->required()
                ->maxLength(255),

            TextInput::make('author')
                ->label('Author')
                ->placeholder('Enter author name')
                ->required()
                ->maxLength(255),

            TextInput::make('publisher')
                ->label('Publisher')
                ->placeholder('Enter publisher name')
                ->required()
                ->maxLength(255),

            TextInput::make('year')
                ->label('Publication Year')
                ->numeric()
                ->required(),

            TextInput::make('stock')
                ->label('Stock Quantity')
                ->numeric()
                ->default(0)
                ->required(),
        ];

        return $schema->components($fields);
    }
}