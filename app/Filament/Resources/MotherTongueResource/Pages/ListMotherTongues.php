<?php

namespace App\Filament\Resources\MotherTongueResource\Pages;

use App\Filament\Resources\MotherTongueResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMotherTongues extends ListRecords
{
    protected static string $resource = MotherTongueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
