<?php

namespace App\Filament\Resources\Encargos\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class EncargoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name'),
                TextInput::make('marca')
                    ->required(),
                TextInput::make('producto')
                    ->required(),
                TextInput::make('talla'),
                TextInput::make('color'),
                TextInput::make('link_referencia'),
                TextInput::make('presupuesto')
                    ->numeric(),
                TextInput::make('anticipo')
                    ->numeric(),
                Select::make('status')
                    ->options([
            'recibido' => 'Recibido',
            'cotizando' => 'Cotizando',
            'aprobado' => 'Aprobado',
            'en_camino' => 'En camino',
            'listo' => 'Listo',
            'entregado' => 'Entregado',
        ])
                    ->default('recibido')
                    ->required(),
                Textarea::make('notas_cliente')
                    ->columnSpanFull(),
                Textarea::make('notas_admin')
                    ->columnSpanFull(),
                TextInput::make('wa_link'),
            ]);
    }
}
