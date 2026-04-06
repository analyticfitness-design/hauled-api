<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $nike  = Brand::where('name', 'Nike')->first();
        $aj    = Brand::where('name', 'Jordan')->first();
        $tommy = Brand::where('name', 'Tommy Hilfiger')->first();
        $adidas = Brand::where('name', 'Adidas')->first();

        $camHombre = Category::where('slug', 'camisetas-hombre')->first();
        $panHombre = Category::where('slug', 'pantalones-hombre')->first();
        $camMujer  = Category::where('slug', 'camisetas-mujer')->first();
        $hoodies   = Category::where('slug', 'hoodies')->first();

        $products = [
            [
                'title'        => 'Nike Dri-FIT T-Shirt',
                'slug'         => 'nike-dri-fit-tshirt',
                'description'  => 'Camiseta deportiva Nike Dri-FIT importada desde USA. Original outlet.',
                'price'        => 8500000,
                'hauled_line'  => 'originals',
                'brand_id'     => $nike?->id,
                'category_id'  => $camHombre?->id,
                'sizes'        => ['S','M','L','XL'],
                'images'       => ['/img/products/originals/placeholder.jpg'],
                'is_active'    => true,
                'stock'        => 5,
            ],
            [
                'title'        => 'Air Jordan 1 Retro High OG',
                'slug'         => 'air-jordan-1-retro-high-og',
                'description'  => 'Icónicas Air Jordan 1 originales USA. Edición limitada outlet.',
                'price'        => 45000000,
                'hauled_line'  => 'originals',
                'brand_id'     => $aj?->id,
                'category_id'  => $panHombre?->id,
                'sizes'        => ['8','9','10','11','12'],
                'images'       => ['/img/products/originals/placeholder.jpg'],
                'is_active'    => true,
                'stock'        => 2,
            ],
            [
                'title'        => 'HAULED Basic Tee',
                'slug'         => 'hauled-basic-tee',
                'description'  => 'Camiseta básica marca propia HAULED. Algodón premium 100%.',
                'price'        => 5900000,
                'hauled_line'  => 'basics',
                'brand_id'     => null,
                'category_id'  => $camHombre?->id,
                'sizes'        => ['XS','S','M','L','XL','XXL'],
                'images'       => ['/img/products/originals/placeholder.jpg'],
                'is_active'    => true,
                'stock'        => 20,
            ],
            [
                'title'        => 'Tommy Hilfiger Hoodie',
                'slug'         => 'tommy-hilfiger-hoodie',
                'description'  => 'Hoodie original Tommy Hilfiger importado desde USA outlet.',
                'price'        => 22000000,
                'hauled_line'  => 'originals',
                'brand_id'     => $tommy?->id,
                'category_id'  => $hoodies?->id,
                'sizes'        => ['S','M','L','XL'],
                'images'       => ['/img/products/originals/placeholder.jpg'],
                'is_active'    => true,
                'stock'        => 3,
            ],
        ];

        foreach ($products as $data) {
            Product::create($data);
        }
    }
}
