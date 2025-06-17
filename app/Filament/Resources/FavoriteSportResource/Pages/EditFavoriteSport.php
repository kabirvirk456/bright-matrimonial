<?php

namespace App\Filament\Resources\FavoriteSportResource\Pages;

use App\Filament\Resources\FavoriteSportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFavoriteSport extends EditRecord
{
    protected static string $resource = FavoriteSportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
