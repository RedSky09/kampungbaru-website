<?php

namespace App\Filament\Resources\Beritas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Filament\Forms\Components\RichEditor;

class BeritaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('judul')
                ->label('Judul')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(function (string $operation, $state, callable $set) {
                    // slug otomatis hanya saat CREATE
                    if ($operation === 'create') {
                        $set('slug', Str::slug($state));
                    }
                }),

            TextInput::make('slug')
                ->label('Slug')
                ->required()
                ->unique(ignoreRecord: true)
                ->helperText('Otomatis dari judul, bisa diubah manual'),

            FileUpload::make('thumbnail')
                ->label('Thumbnail')
                ->image()
                ->disk('public')
                ->directory('berita/thumbnails')
                ->imagePreviewHeight(200)
                ->maxSize(2048) // 2MB
                ->nullable(),

            Toggle::make('is_published')
                ->label('Publikasikan')
                ->default(true),

            Textarea::make('ringkasan')
            ->label('Ringkasan')
            ->rows(3)
            ->disabled()
            ->columnSpanFull(),

            RichEditor::make('konten')
            ->label('Isi Berita')
            ->required()
            ->columnSpanFull()
            ->afterStateUpdated(function ($state, callable $set) {
                $set(
                    'ringkasan',
                    Str::limit(strip_tags($state), 30)
                );
            }),
        ]);
    }
}
