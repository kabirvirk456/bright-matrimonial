<?php

namespace App\Filament\Resources\MotherTongueResource\Pages;

use App\Filament\Resources\MotherTongueResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMotherTongue extends EditRecord
{
    protected static string $resource = MotherTongueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
