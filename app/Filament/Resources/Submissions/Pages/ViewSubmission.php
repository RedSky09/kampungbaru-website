<?php

namespace App\Filament\Resources\Submissions\Pages;

use App\Filament\Resources\Submissions\SubmissionResource;
use App\Models\Submission;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms\Components\Textarea;

class ViewSubmission extends ViewRecord
{
    protected static string $resource = SubmissionResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Action::make('approve')
            ->label('Setujui')
            ->color('success')
            ->extraAttributes([
                'class' => 'text-white hover:text-white',
            ])
            ->visible(fn (Submission $record) => $record->status === 'pending')
            ->action(function (Submission $record) {
                $record->status = 'approved';
                $record->save();
            }),
            
            Action::make('reject')
            ->label('Tolak')
            ->color('danger')
            ->visible(fn (Submission $record) => $record->status === 'pending')
            ->modalHeading('Tolak Pengajuan')
            ->form([
                Textarea::make('rejection_reason')
                ->label('Alasan Penolakan')
                ->required()
                ->maxLength(500),
            ])
            ->action(function (Submission $record, array $data) {
                $record->status = 'rejected';
                $record->rejection_reason = $data['rejection_reason'];
                $record->save();
            }),
            
            Action::make('finish')
            ->label('Selesaikan')
            ->color('primary')
            ->visible(fn (Submission $record) => $record->status === 'approved')
            ->requiresConfirmation()
            ->action(function (Submission $record) {
                $record->status = 'finished';
                $record->completed_at = now();
                $record->save();
            }),
        ];
    } 
}
