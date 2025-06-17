<?php

namespace App\Filament\Resources\FavoriteMusicResource\Pages;

use App\Filament\Resources\FavoriteMusicResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFavoriteMusic extends EditRecord
{
    protected static string $resource = FavoriteMusicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
