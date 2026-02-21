<?php

namespace App\Filament\Resources\Officials;

use App\Filament\Resources\Officials\Pages\CreateOfficial;
use App\Filament\Resources\Officials\Pages\EditOfficial;
use App\Filament\Resources\Officials\Pages\ListOfficials;

use App\Models\Official;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class OfficialResource extends Resource
{
    protected static ?string $model = Official::class;
    protected static ?string $navigationLabel = 'Pemerintah';
    protected static ?string $modelLabel = 'Pemerintah';
    protected static ?string $pluralModelLabel = 'Pemerintah';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            FileUpload::make('photo')
            ->image()
            ->disk('public' )
            ->directory('officials')
            ->nullable(),
            
            TextInput::make('name')
            ->required(),

            TextInput::make('position')
            ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            ImageColumn::make('photo')
            ->disk('public')
            ->square(),

            TextColumn::make('name')
            ->searchable(),
            
            TextColumn::make('position'),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOfficials::route('/'),
            'create' => CreateOfficial::route('/create'),
            'edit' => EditOfficial::route('/{record}/edit'),
        ];
    }
}
