<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            'Nike', 'Adidas', 'Jordan', 'New Balance',
            'Tommy Hilfiger', 'Ralph Lauren', "Levi's", 'Champion',
            'GASP',
        ];

        foreach ($brands as $name) {
            Brand::create(['name' => $name]);
        }
    }
}
