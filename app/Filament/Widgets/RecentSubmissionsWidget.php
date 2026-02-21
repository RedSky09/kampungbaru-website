<?php

namespace App\Filament\Widgets;

use App\Models\Submission;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentSubmissionsWidget extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';
    
    public function table(Table $table): Table
    {
        return $table
            ->heading('Pengajuan Terbaru')
            ->description('10 pengajuan terbaru yang masuk ke sistem')
            ->query(
                Submission::query()
                    ->latest()
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Kode')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->weight('bold')
                    ->color('primary')
                    ->url(fn (Submission $record): string => "/admin/submissions/{$record->id}"),
                
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->limit(20),
                
                Tables\Columns\TextColumn::make('service_type')
                    ->label('Jenis Layanan')
                    ->searchable()
                    ->wrap()
                    ->limit(35),
                
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Menunggu',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        'finished' => 'Selesai',
                        default => $state,
                    })
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending'   => 'warning',
                        'approved'  => 'info',
                        'rejected'  => 'danger',
                        'finished'  => 'success',
                        default     => 'gray',
                    }),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu')
                    ->sortable()
                    ->since()
                    ->dateTime('d M Y, H:i')
                    ->tooltip(fn ($record) => $record->created_at->format('d M Y, H:i')),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordUrl(fn (Submission $record): string => "/admin/submissions/{$record->id}")
            ->striped();
    }
}