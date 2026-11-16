<?php

namespace App\Filament\Widgets;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    /**
     * Retrieve the statistics overview metrics for the dashboard.
     */
    protected function getStats(): array
    {
        $totalBooks       = Book::query()->count();
        $totalStudents    = User::query()->where('role', 'siswa')->count();
        $activeLoansCount = Loan::query()->where('status', 'dipinjam')->count();

        $widgetStats = [
            Stat::make('Judul Buku', $totalBooks)
                ->description('Total registered book catalog')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('success')
                ->icon('heroicon-o-book-open'),

            Stat::make('Anggota', $totalStudents)
                ->description('Total active student members')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info')
                ->icon('heroicon-o-users'),

            Stat::make('Sedang Dipinjam', $activeLoansCount)
                ->description('Books currently checked out')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning')
                ->icon('heroicon-o-bookmark'),
        ];

        return $widgetStats;
    }
}
