<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FavoriteMovieResource\Pages;
use App\Models\FavoriteMovie;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class FavoriteMovieResource extends Resource
{
    protected static ?string $model = FavoriteMovie::class;

    protected static ?string $navigationIcon = 'heroicon-o-film';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Movie Name')
                    ->required()
                    ->unique(ignoreRecord: true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('name')->label('Movie Name')->searchable()->sortable(),
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
            'index' => Pages\ListFavoriteMovies::route('/'),
            'create' => Pages\CreateFavoriteMovie::route('/create'),
            'edit' => Pages\EditFavoriteMovie::route('/{record}/edit'),
        ];
    }
}
