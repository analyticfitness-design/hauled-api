<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('compare_price')
                    ->numeric()
                    ->prefix('$'),
                Select::make('hauled_line')
                    ->options(['originals' => 'Originals', 'basics' => 'Basics', 'encargo' => 'Encargo'])
                    ->default('originals')
                    ->required(),
                Select::make('brand_id')
                    ->relationship('brand', 'name'),
                Select::make('category_id')
                    ->relationship('category', 'name'),
                TextInput::make('sizes'),
                TextInput::make('images'),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
