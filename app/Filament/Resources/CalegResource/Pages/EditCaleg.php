<?php

namespace App\Filament\Resources\CalegResource\Pages;

use App\Filament\Resources\CalegResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCaleg extends EditRecord
{
    protected static string $resource = CalegResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
