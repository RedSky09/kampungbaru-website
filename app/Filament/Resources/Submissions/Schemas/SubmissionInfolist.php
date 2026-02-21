<?php

namespace App\Filament\Resources\Submissions\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Support\Facades\Storage;
use App\Models\Submission;

class SubmissionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Data Pengajuan')
                ->schema([
                    TextEntry::make('code')
                        ->label('Kode Pengajuan')
                        ->copyable(),

                    TextEntry::make('service_type')
                        ->label('Jenis Surat'),

                    TextEntry::make('name')
                        ->label('Nama'),

                    TextEntry::make('nik')
                        ->label('NIK'),

                    TextEntry::make('phone')
                        ->label('No. HP'),

                    TextEntry::make('note')
                        ->label('Catatan')
                        ->placeholder('-')
                        ->columnSpanFull(),
                ])
                ->columns(2),

            Section::make('Dokumen Lampiran')
                ->description('Klik nama dokumen untuk melihat/download')
                ->schema([
                    TextEntry::make('documents_display')
                        ->label('')
                        ->html()
                        ->getStateUsing(function (Submission $record) {
                            $paths = $record->document_path;
                            
                            if (empty($paths)) {
                                return '<div class="text-gray-400 italic">Tidak ada dokumen</div>';
                            }

                            // Normalize to array
                            $paths = is_string($paths) ? [$paths] : $paths;

                            if (empty($paths)) {
                                return '<div class="text-gray-400 italic">Tidak ada dokumen</div>';
                            }

                            $html = '<div class="space-y-3">';
                            $counter = 1;
                            
                            foreach ($paths as $path) {
                                if (empty($path)) {
                                    continue;
                                }
                                
                                $url = Storage::url($path);
                                $fileName = basename($path);
                                $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                                
                                // Tentukan icon dan warna
                                [$icon, $bgColor, $textColor, $type] = match($extension) {
                                    'jpg', 'jpeg', 'png', 'gif', 'webp', 'svg' => [
                                        '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>',
                                        'bg-blue-100 dark:bg-blue-900/30',
                                        'text-blue-700 dark:text-blue-300',
                                        'Gambar'
                                    ],
                                    'pdf' => [
                                        '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>',
                                        'bg-red-100 dark:bg-red-900/30',
                                        'text-red-700 dark:text-red-300',
                                        'PDF'
                                    ],
                                    'doc', 'docx' => [
                                        '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>',
                                        'bg-blue-100 dark:bg-blue-900/30',
                                        'text-blue-700 dark:text-blue-300',
                                        'Word'
                                    ],
                                    'xls', 'xlsx' => [
                                        '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>',
                                        'bg-green-100 dark:bg-green-900/30',
                                        'text-green-700 dark:text-green-300',
                                        'Excel'
                                    ],
                                    default => [
                                        '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>',
                                        'bg-gray-100 dark:bg-gray-800',
                                        'text-gray-700 dark:text-gray-300',
                                        'File'
                                    ],
                                };
                                
                                $html .= '
                                <div class="flex items-center gap-3 p-3 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-lg ' . $bgColor . ' ' . $textColor . ' flex items-center justify-center">
                                        ' . $icon . '
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="font-semibold text-gray-900 dark:text-gray-100">
                                            Dokumen ' . $counter . '
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            ' . $type . ' • ' . strtoupper($extension) . '
                                        </div>
                                    </div>
                                    <div class="flex gap-2">
                                        <a href="' . htmlspecialchars($url) . '" 
                                           target="_blank"
                                           class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-800 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            Lihat
                                        </a>
                                        <a href="' . htmlspecialchars($url) . '" 
                                           download="Dokumen_' . $counter . '.' . $extension . '"
                                           class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                            </svg>
                                            Download
                                        </a>
                                    </div>
                                </div>
                                ';
                                
                                $counter++;
                            }
                            
                            $html .= '</div>';
                            
                            return $html;
                        }),
                ]),

            Section::make('Status Pengajuan')
                ->schema([
                    TextEntry::make('status')
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
                            'pending'   => 'gray',
                            'approved'  => 'success',
                            'rejected'  => 'danger',
                            'finished'  => 'primary',
                            default     => 'gray',
                        }),

                    TextEntry::make('rejection_reason')
                        ->label('Alasan Penolakan')
                        ->placeholder('-')
                        ->visible(fn ($record): bool => $record?->status === 'rejected'),

                    TextEntry::make('created_at')
                        ->label('Diajukan Pada')
                        ->dateTime('d M Y, H:i'),

                    TextEntry::make('updated_at')
                        ->label('Terakhir Diperbarui')
                        ->dateTime('d M Y, H:i'),
                ]),
        ]);
    }
}