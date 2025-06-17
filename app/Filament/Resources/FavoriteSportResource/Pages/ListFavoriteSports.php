<?php

namespace App\Filament\Resources\FavoriteSportResource\Pages;

use App\Filament\Resources\FavoriteSportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFavoriteSports extends ListRecords
{
    protected static string $resource = FavoriteSportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
