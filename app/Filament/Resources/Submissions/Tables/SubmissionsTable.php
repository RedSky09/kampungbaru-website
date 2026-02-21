<?php

namespace App\Filament\Resources\Submissions\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\ViewAction;

class SubmissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
        ->defaultSort('created_at', 'desc')
        ->columns([
            TextColumn::make('code')
            ->label('Kode')
            ->searchable()
            ->copyable(),

            TextColumn::make('service_type')
            ->label('Jenis Surat')
            ->badge(),

            TextColumn::make('name')
            ->label('Nama')
            ->searchable(),

            TextColumn::make('nik')
            ->label('NIK')
            ->searchable(),

            TextColumn::make('phone')
            ->label('No. HP'),

            TextColumn::make('status')
            ->label('Status')
            ->badge()
            ->color(fn (string $state) => match ($state) {
                'pending'   => 'warning',
                'approved'  => 'success',
                'rejected'  => 'danger',
                'finished' => 'primary',
                default     => 'gray',
                }),

            TextColumn::make('created_at')
            ->label('Diajukan')
            ->dateTime('d M Y H:i')
            ->sortable(),
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([]);
    }
}
