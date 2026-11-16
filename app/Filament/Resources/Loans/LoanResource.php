<?php

namespace App\Filament\Resources\Loans;

use App\Filament\Resources\Loans\Pages\CreateLoan;
use App\Filament\Resources\Loans\Pages\EditLoan;
use App\Filament\Resources\Loans\Pages\ListLoans;
use App\Filament\Resources\Loans\Schemas\LoanForm;
use App\Filament\Resources\Loans\Tables\LoansTable;
use App\Models\Loan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class LoanResource extends Resource
{
    protected static ?string $model = Loan::class;

    protected static ?string $recordTitleAttribute = 'status';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Loan Management';

    public static function form(Schema $schema): Schema
    {
        return LoanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LoansTable::configure($table);
    }

    public static function getPages(): array
    {
        $pagesMapping = [
            'index'  => ListLoans::route('/'),
            'create' => CreateLoan::route('/create'),
            'edit'   => EditLoan::route('/{record}/edit'),
        ];

        return $pagesMapping;
    }

    public static function getRelations(): array
    {
        $relationDefinitions = [
            //
        ];

        return $relationDefinitions;
    }

    public static function getEloquentQuery(): Builder
    {
        $builderQuery = parent::getEloquentQuery();

        if (auth()->user()->isAdmin() === false) {
            $builderQuery->where('user_id', auth()->id());
        }

        return $builderQuery;
    }

    public static function getAuthorizationResponse(string $action, ?Model $record = null): Response
    {
        if ($action === 'viewAny') {
            return Response::allow();
        }

        return Response::deny();
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['status'];
    }
}