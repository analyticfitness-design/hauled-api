<?php

namespace App\Filament\Resources\Encargos\Pages;

use App\Filament\Resources\Encargos\EncargoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEncargo extends EditRecord
{
    protected static string $resource = EncargoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
