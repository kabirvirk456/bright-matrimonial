<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FavoriteMusicResource\Pages;
use App\Models\FavoriteMusic;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class FavoriteMusicResource extends Resource
{
    protected static ?string $model = FavoriteMusic::class;

    protected static ?string $navigationIcon = 'heroicon-o-musical-note';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Music Name')
                    ->required()
                    ->unique(ignoreRecord: true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('name')->label('Music Name')->searchable()->sortable(),
                TextColumn::make('created_at')->dateTime('d M Y')->label('Created At'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListFavoriteMusic::route('/'),
            'create' => Pages\CreateFavoriteMusic::route('/create'),
            'edit' => Pages\EditFavoriteMusic::route('/{record}/edit'),
        ];
    }
}
