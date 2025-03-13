<?php

namespace App\Filament\Resources\ExcursionResource\Pages;

use App\Filament\Resources\ExcursionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateExcursion extends CreateRecord
{
    protected static string $resource = ExcursionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::user()->id;
        return $data;
    }
}
