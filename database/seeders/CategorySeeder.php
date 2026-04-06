<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $parents = [
            ["name" => "Hombre",  "slug" => "hombre"],
            ["name" => "Mujer",   "slug" => "mujer"],
            ["name" => "Unisex",  "slug" => "unisex"],
        ];

        foreach ($parents as $p) {
            Category::create($p);
        }

        $hombre = Category::where("slug", "hombre")->first();
        $mujer  = Category::where("slug", "mujer")->first();
        $unisex = Category::where("slug", "unisex")->first();

        $subs = [
            ["name" => "Camisetas",    "slug" => "camisetas-hombre",    "parent_id" => $hombre->id],
            ["name" => "Pantalones",   "slug" => "pantalones-hombre",   "parent_id" => $hombre->id],
            ["name" => "Chaquetas",    "slug" => "chaquetas-hombre",    "parent_id" => $hombre->id],
            ["name" => "Zapatos",      "slug" => "zapatos-hombre",      "parent_id" => $hombre->id],
            ["name" => "Camisetas",    "slug" => "camisetas-mujer",     "parent_id" => $mujer->id],
            ["name" => "Vestidos",     "slug" => "vestidos-mujer",      "parent_id" => $mujer->id],
            ["name" => "Jeans",        "slug" => "jeans-mujer",         "parent_id" => $mujer->id],
            ["name" => "Zapatos",      "slug" => "zapatos-mujer",       "parent_id" => $mujer->id],
            ["name" => "Gorras",       "slug" => "gorras",              "parent_id" => $unisex->id],
            ["name" => "Accesorios",   "slug" => "accesorios",          "parent_id" => $unisex->id],
            ["name" => "Hoodies",      "slug" => "hoodies",             "parent_id" => $unisex->id],
        ];

        foreach ($subs as $sub) {
            Category::create($sub);
        }
    }
}
