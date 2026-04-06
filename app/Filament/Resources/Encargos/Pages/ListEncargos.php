<?php

namespace App\Filament\Resources\Encargos\Pages;

use App\Filament\Resources\Encargos\EncargoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEncargos extends ListRecords
{
    protected static string $resource = EncargoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
