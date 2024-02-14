<?php

namespace App\Filament\Resources\QuickCountResource\Pages;

use App\Filament\Resources\QuickCountResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuickCount extends EditRecord
{
    protected static string $resource = QuickCountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
