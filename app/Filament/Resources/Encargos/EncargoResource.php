<?php

namespace App\Filament\Resources\Encargos;

use App\Filament\Resources\Encargos\Pages\CreateEncargo;
use App\Filament\Resources\Encargos\Pages\EditEncargo;
use App\Filament\Resources\Encargos\Pages\ListEncargos;
use App\Filament\Resources\Encargos\Schemas\EncargoForm;
use App\Filament\Resources\Encargos\Tables\EncargosTable;
use App\Models\Encargo;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EncargoResource extends Resource
{
    protected static ?string $model = Encargo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'marca';

    public static function form(Schema $schema): Schema
    {
        return EncargoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EncargosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEncargos::route('/'),
            'create' => CreateEncargo::route('/create'),
            'edit' => EditEncargo::route('/{record}/edit'),
        ];
    }
}
