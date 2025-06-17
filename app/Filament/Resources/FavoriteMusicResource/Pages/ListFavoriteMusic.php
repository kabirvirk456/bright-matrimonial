<?php

namespace App\Filament\Resources\FavoriteMusicResource\Pages;

use App\Filament\Resources\FavoriteMusicResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFavoriteMusic extends ListRecords
{
    protected static string $resource = FavoriteMusicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
