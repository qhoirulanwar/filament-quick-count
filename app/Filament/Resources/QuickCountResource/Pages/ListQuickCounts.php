<?php

namespace App\Filament\Resources\QuickCountResource\Pages;

use App\Filament\Resources\QuickCountResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuickCounts extends ListRecords
{
    protected static string $resource = QuickCountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
