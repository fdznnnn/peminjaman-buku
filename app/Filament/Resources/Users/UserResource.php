<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Tables\UsersTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Model;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'User Management';

    /**
     * Configure the form schema for user resource.
     */
    public static function form(Schema $schema): Schema
    {
        return UserForm::configure($schema);
    }

    /**
     * Configure the table layout for user resource.
     */
    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
    }

    /**
     * Get the registered pages for this resource.
     */
    public static function getPages(): array
    {
        $userPagesMapping = [
            'index'  => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit'   => EditUser::route('/{record}/edit'),
        ];

        return $userPagesMapping;
    }

    /**
     * Get relationship definitions.
     */
    public static function getRelations(): array
    {
        $relationList = [
            //
        ];

        return $relationList;
    }

    /**
     * Authorize actions for the user resource.
     */
    public static function getAuthorizationResponse(string $action, ?Model $record = null): Response
    {
        if (auth()->user()->isAdmin() === true) {
            return Response::allow();
        }

        return Response::deny();
    }

    /**
     * Define global search attributes.
     */
    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email'];
    }
}