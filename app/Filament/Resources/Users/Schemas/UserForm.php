<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    /**
     * Configure the user resource form schema components.
     */
    public static function configure(Schema $schema): Schema
    {
        $userFormComponents = [
            TextInput::make('name')
                ->label('Full Name')
                ->placeholder('Enter user full name')
                ->required()
                ->maxLength(255),

            TextInput::make('email')
                ->label('Email Address')
                ->placeholder('user@example.com')
                ->email()
                ->required()
                ->maxLength(255),

            Select::make('role')
                ->label('User Role')
                ->options([
                    'admin' => 'Admin',
                    'siswa' => 'Siswa',
                ])
                ->required()
                ->default('siswa')
                ->native(false),

            TextInput::make('kelas')
                ->label('Class / Kelas')
                ->placeholder('Optional class name')
                ->default(null)
                ->maxLength(100),

            TextInput::make('password')
                ->label('Password')
                ->password()
                ->placeholder('Enter secure password')
                ->dehydrated(fn (?string $state): bool => filled($state))
                ->required(fn (string $operation): bool => $operation === 'create')
                ->maxLength(255),
        ];

        return $schema->components($userFormComponents);
    }
}