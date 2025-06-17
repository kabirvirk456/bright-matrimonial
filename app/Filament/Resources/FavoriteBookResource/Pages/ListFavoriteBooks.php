<?php

namespace App\Filament\Resources\FavoriteBookResource\Pages;

use App\Filament\Resources\FavoriteBookResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFavoriteBooks extends ListRecords
{
    protected static string $resource = FavoriteBookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
