<?php

namespace App\Filament\Resources\CalegResource\Pages;

use App\Filament\Resources\CalegResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCalegs extends ListRecords
{
    protected static string $resource = CalegResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
