<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CasteResource\Pages;
use App\Models\Caste;
use App\Models\Religion;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class CasteResource extends Resource
{
    protected static ?string $model = Caste::class;
    protected static ?string $navigationIcon = 'heroicon-o-bookmark'; // <-- FIXED HERE
    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(100),
            Forms\Components\Select::make('religion_id')
                ->label('Religion')
                ->options(Religion::all()->pluck('name', 'id')->toArray())
                ->searchable()
                ->required(),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('id')->sortable(),
            Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('religion.name')->label('Religion')->sortable(),
            Tables\Columns\TextColumn::make('created_at')->date('d-M-Y'),
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCastes::route('/'),
            'create' => Pages\CreateCaste::route('/create'),
            'edit' => Pages\EditCaste::route('/{record}/edit'),
        ];
    }
}
