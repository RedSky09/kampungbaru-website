<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use BackedEnum;
use Filament\Support\Icons\Heroicon;

class Dashboard extends BaseDashboard
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;
    
    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\SubmissionStatsWidget::class,
            \App\Filament\Widgets\RecentSubmissionsWidget::class,
            \App\Filament\Widgets\SubmissionChartWidget::class,
        ];
    }
}