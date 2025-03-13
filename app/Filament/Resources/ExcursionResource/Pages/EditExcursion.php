<?php

namespace App\Filament\Resources\ExcursionResource\Pages;

use App\Filament\Resources\ExcursionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExcursion extends EditRecord
{
    protected static string $resource = ExcursionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
