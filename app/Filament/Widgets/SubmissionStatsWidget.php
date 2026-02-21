<?php

namespace App\Filament\Widgets;

use App\Models\Submission;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SubmissionStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        // Total pengajuan
        $total = Submission::count();
        
        // Pengajuan hari ini
        $today = Submission::whereDate('created_at', today())->count();
        
        // Status counts
        $pending = Submission::where('status', 'pending')->count();
        $approved = Submission::where('status', 'approved')->count();
        $rejected = Submission::where('status', 'rejected')->count();
        $finished = Submission::where('status', 'finished')->count();
        
        // Growth calculation (vs bulan lalu)
        $thisMonth = Submission::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $lastMonth = Submission::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();
        
        $growth = $lastMonth > 0 
            ? round((($thisMonth - $lastMonth) / $lastMonth) * 100, 1)
            : 0;

        return [
            Stat::make('Total Pengajuan', $total)
                ->description($today . ' pengajuan hari ini')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('primary')
                ->chart([7, 12, 15, 18, 22, 25, $total]),
            
            Stat::make('Menunggu Persetujuan', $pending)
                ->description('Perlu ditindaklanjuti')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
            
            Stat::make('Disetujui', $approved)
                ->description('Sedang diproses')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Ditolak', $rejected)
                ->description('Ditolak')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),
            
            Stat::make('Selesai', $finished)
                ->description($growth >= 0 ? "+{$growth}% dari bulan lalu" : "{$growth}% dari bulan lalu")
                ->descriptionIcon($growth >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color('primary')
                ->chart([$lastMonth, $thisMonth]),
        ];
    }
}
