<?php

namespace App\Filament\Resources\ExcursionResource\Pages;

use App\Filament\Resources\ExcursionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExcursions extends ListRecords
{
    protected static string $resource = ExcursionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
