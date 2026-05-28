<?php

namespace App\Filament\Resources\EPIResource\Pages;

use App\Filament\Resources\EPIResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEPIS extends ListRecords
{
    protected static string $resource = EPIResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
