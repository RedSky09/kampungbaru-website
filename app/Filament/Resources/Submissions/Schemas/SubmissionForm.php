<?php

namespace App\Filament\Resources\Submissions\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

// FORM COMPONENTS TETAP DARI Forms
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;

class SubmissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Data Pengajuan')
                ->schema([
                    TextInput::make('code')->disabled(),
                    TextInput::make('service_type')->disabled(),
                    TextInput::make('name')->disabled(),
                    TextInput::make('nik')->disabled(),
                    TextInput::make('phone')->disabled(),

                    FileUpload::make('document')
                        ->disk('public')
                        ->openable()
                        ->downloadable()
                        ->disabled(),
                ])
                ->columns(2),
                
                Section::make('Status Pengajuan')
                ->schema([
                    Select::make('status')
                        ->options([
                            'pending'   => 'Menunggu',
                            'approved'  => 'Disetujui',
                            'rejected'  => 'Ditolak',
                            'finished' => 'Selesai',
                        ])
                        ->disabled(fn ($record) => $record?->status === 'finished'),

                    Textarea::make('rejection_reason')
                        ->label('Alasan Penolakan')
                        ->visible(fn ($get) => $get('status') === 'rejected')
                        ->required(fn ($get) => $get('status') === 'rejected')
                        ->disabled(fn ($record) => $record?->status === 'finished'),
                ]),
        ]);
    }
}
