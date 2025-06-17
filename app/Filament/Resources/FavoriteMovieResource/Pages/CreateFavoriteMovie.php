<?php

namespace App\Filament\Resources\FavoriteMovieResource\Pages;

use App\Filament\Resources\FavoriteMovieResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFavoriteMovie extends CreateRecord
{
    protected static string $resource = FavoriteMovieResource::class;
}
