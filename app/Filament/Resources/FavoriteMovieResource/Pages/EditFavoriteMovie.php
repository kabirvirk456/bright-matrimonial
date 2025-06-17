<?php

namespace App\Filament\Resources\FavoriteMovieResource\Pages;

use App\Filament\Resources\FavoriteMovieResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFavoriteMovie extends EditRecord
{
    protected static string $resource = FavoriteMovieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
