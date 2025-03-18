<?php

namespace App\Filament\Resources\ExcursionResource\Pages;

use App\Filament\Resources\ExcursionResource;
use Filament\Notifications\Notification;
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

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Excursion successfully created')
            ->body('Please pay attention to the dates that need to be added.');
    }
}
