<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Seeder;

class FixGaspBrandSeeder extends Seeder
{
    public function run(): void
    {
        $gaspId = Brand::where('name', 'GASP')->value('id');

        $slugs = [
            'gasp-tactical-backpack',
            'gasp-neoprene-knee-sleeves',
            'gasp-zeus-thunderbolt-v2',
            'gasp-gym-pant',
            'gasp-track-suit-pants-v2',
            'gasp-sweatpants',
            'gasp-89-mesh-tank',
            'gasp-iron-camp-baggy-pants',
            'gasp-washed-baggy-pants',
            'gasp-ribbed-tback',
            'gasp-legacy-gym-tee',
            'gasp-two-color-iron-tee',
            'gasp-core-mesh-pants',
            'gasp-original-cutout-tank',
            'gasp-skull-tback',
            'gasp-training-bag-toalla',
        ];

        $updated = Product::whereIn('slug', $slugs)->update(['brand_id' => $gaspId]);
        $this->command->info("Actualizados {$updated} productos con brand_id={$gaspId} (GASP).");
    }
}
