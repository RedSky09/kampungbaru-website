<?php

namespace App\Filament\Resources\Officials\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class OfficialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
        FileUpload::make('photo')
            ->label('Foto')
            ->image()
            ->directory('officials')
            ->imageEditor()
            ->columnSpanFull(),

        TextInput::make('name')
            ->label('Nama')
            ->required()
            ->maxLength(100),

        TextInput::make('position')
            ->label('Jabatan')
            ->required()
            ->maxLength(100),
        ]);
    }
}
