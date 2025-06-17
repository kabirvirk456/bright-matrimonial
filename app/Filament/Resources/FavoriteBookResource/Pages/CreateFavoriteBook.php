<?php

namespace App\Filament\Resources\FavoriteBookResource\Pages;

use App\Filament\Resources\FavoriteBookResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFavoriteBook extends CreateRecord
{
    protected static string $resource = FavoriteBookResource::class;
}
