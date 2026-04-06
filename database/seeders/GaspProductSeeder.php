<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

/**
 * Productos GASP disponibles en HAULED.
 * Precios: price_usd en centavos USD, price en centavos COP (USD × 4,200 × 100).
 * Imágenes: /img/products/gasp/{slug}-{n}.jpg (3 fotos por producto, máxima calidad).
 */
class GaspProductSeeder extends Seeder
{
    // Tasa de cambio COP por USD → centavos COP = usd_cents × 42
    private const USD_TO_COP_CENTS = 42; // 1 USD = 4,200 COP → 1 cent USD = 42 centavos COP

    public function run(): void
    {
        $gasp       = Brand::where('name', 'GASP')->first();
        $panHombre  = Category::where('slug', 'pantalones-hombre')->first();
        $camHombre  = Category::where('slug', 'camisetas-hombre')->first();
        $zapHombre  = Category::where('slug', 'zapatos-hombre')->first();
        $accesorios = Category::where('slug', 'accesorios')->first();

        $products = [
            [
                'title'       => 'GASP Tactical Backpack',
                'slug'        => 'gasp-tactical-backpack',
                'description' => 'Mochila táctica GASP de 45L con 5 compartimentos principales y bolsillos organizadores internos. Parches removibles con velcro personalizables. Porta-laptop acolchado, porta-botellas con cordón ajustable. Material: 100% Polyester. Importada desde USA.',
                'price_usd'   => 12900, // $129.00 USD en centavos
                'sizes'       => ['One Size'],
                'images'      => [
                    '/img/products/gasp/tactical-backpack-1.jpg',
                    '/img/products/gasp/tactical-backpack-2.jpg',
                    '/img/products/gasp/tactical-backpack-3.jpg',
                ],
                'category_id' => $accesorios?->id,
                'hauled_line' => 'originals',
                'stock'       => 1,
            ],
            [
                'title'       => 'GASP Neoprene Knee Sleeves',
                'slug'        => 'gasp-neoprene-knee-sleeves',
                'description' => 'Rodilleras de neopreno GASP 7mm para soporte y calor durante el entrenamiento pesado. Disponibles en tallas S–XXL. Material: Neopreno de alta densidad. Importadas desde USA.',
                'price_usd'   => 6400, // $64.00 USD
                'sizes'       => ['S', 'M', 'L', 'XL', 'XXL'],
                'images'      => [
                    '/img/products/gasp/knee-sleeves-1.jpg',
                    '/img/products/gasp/knee-sleeves-2.jpg',
                    '/img/products/gasp/knee-sleeves-3.jpg',
                ],
                'category_id' => $accesorios?->id,
                'hauled_line' => 'originals',
                'stock'       => 1,
            ],
            [
                'title'       => 'Zeus Thunderbolt V2',
                'slug'        => 'gasp-zeus-thunderbolt-v2',
                'description' => 'Zapato de levantamiento GASP Zeus Thunderbolt V2. Construcción reforzada con 70% cuero suede y suela de caucho 100%. Incluye par extra de cordones. Bordado GASP & Iron World. Tallas EU 36–48. Importados desde USA.',
                'price_usd'   => 11900, // $119.00 USD
                'sizes'       => ['EU 36','EU 37','EU 38','EU 39','EU 40','EU 41','EU 42','EU 43','EU 44','EU 45','EU 46','EU 47','EU 48'],
                'images'      => [
                    '/img/products/gasp/zeus-thunderbolt-1.jpg',
                    '/img/products/gasp/zeus-thunderbolt-2.jpg',
                    '/img/products/gasp/zeus-thunderbolt-3.jpg',
                ],
                'category_id' => $zapHombre?->id,
                'hauled_line' => 'originals',
                'stock'       => 1,
            ],
            [
                'title'       => 'GASP Gym Pant',
                'slug'        => 'gasp-gym-pant',
                'description' => 'Pantalón de entrenamiento GASP corte baggy clásico. Mezcla algodón-polyester-elastano 220gsm para máxima libertad de movimiento. Tobilleras elásticas, bolsillos abiertos. Fit: Baggy. Material: 65% Cotton / 35% Polyester / 5% Elastane. Importado desde USA.',
                'price_usd'   => 5400, // $54.00 USD
                'sizes'       => ['S', 'M', 'L', 'XL', 'XXL', '3XL'],
                'images'      => [
                    '/img/products/gasp/gym-pant-1.jpg',
                    '/img/products/gasp/gym-pant-2.jpg',
                    '/img/products/gasp/gym-pant-3.jpg',
                ],
                'category_id' => $panHombre?->id,
                'hauled_line' => 'originals',
                'stock'       => 3,
            ],
            [
                'title'       => 'GASP Track Suit Pants V2',
                'slug'        => 'gasp-track-suit-pants-v2',
                'description' => 'Pantalón de entrenamiento GASP Track Suit V2. Tela de performance ligera para entrenamiento y viaje. Bolsillos con cierre, cintura elástica, corte cónico. Fit: Athletic. Importado desde USA.',
                'price_usd'   => 8900, // $89.00 USD
                'sizes'       => ['S', 'M', 'L', 'XL', 'XXL', '3XL'],
                'images'      => [
                    '/img/products/gasp/track-suit-pants-v2-1.jpg',
                    '/img/products/gasp/track-suit-pants-v2-2.jpg',
                    '/img/products/gasp/track-suit-pants-v2-3.jpg',
                ],
                'category_id' => $panHombre?->id,
                'hauled_line' => 'originals',
                'stock'       => 1,
            ],
            [
                'title'       => 'GASP Sweatpants',
                'slug'        => 'gasp-sweatpants',
                'description' => 'Sudadera GASP de algodón-polyester slub sin costuras laterales externas. Cintura ajustable con cordón, bolsillos con cierre frontal. Fit regular disponible en largo Regular (R) y Largo (L). Importada desde USA.',
                'price_usd'   => 6400, // $64.00 USD
                'sizes'       => ['XS/S','S/R','S/L','M/R','M/L','L/R','L/L','XL/R','XL/L','XXL/R','XXL/L','3XL/R'],
                'images'      => [
                    '/img/products/gasp/track-pants-1.jpg',
                    '/img/products/gasp/track-pants-2.jpg',
                    '/img/products/gasp/track-pants-3.jpg',
                ],
                'category_id' => $panHombre?->id,
                'hauled_line' => 'originals',
                'stock'       => 1,
            ],
            [
                'title'       => 'GASP 89 Mesh Tank',
                'slug'        => 'gasp-89-mesh-tank',
                'description' => 'Tank top GASP Signature Mesh de malla micro-ventilada para máxima ventilación bajo carga intensa. Paneles laterales, aplicaciones impresas, logo bordado, etiqueta tejida. Material: 100% Polyester GASP Signature Mesh. Importado desde USA.',
                'price_usd'   => 11900, // $119.00 USD
                'sizes'       => ['S', 'M', 'L', 'XL', 'XXL', '3XL', '4XL'],
                'images'      => [
                    '/img/products/gasp/89-mesh-tank-1.jpg',
                    '/img/products/gasp/89-mesh-tank-2.jpg',
                    '/img/products/gasp/89-mesh-tank-3.jpg',
                ],
                'category_id' => $camHombre?->id,
                'hauled_line' => 'originals',
                'stock'       => 1,
            ],
            [
                'title'       => 'GASP Iron Camp Baggy Pants',
                'slug'        => 'gasp-iron-camp-baggy-pants',
                'description' => 'Pantalón old school baggy GASP de corte extra holgado para día de piernas brutales. Mezcla de algodón pesado, cintura elástica con cordón ajustable. El silhueta oversized que definió el culturismo hardcore. Importado desde USA.',
                'price_usd'   => 7400, // $74.00 USD
                'sizes'       => ['S', 'M', 'L', 'XL', 'XXL', '3XL'],
                'images'      => [
                    '/img/products/gasp/iron-camp-baggy-1.jpg',
                    '/img/products/gasp/iron-camp-baggy-2.jpg',
                    '/img/products/gasp/iron-camp-baggy-3.jpg',
                ],
                'category_id' => $panHombre?->id,
                'hauled_line' => 'originals',
                'stock'       => 1,
            ],
            [
                'title'       => 'GASP Washed Baggy Pants',
                'slug'        => 'gasp-washed-baggy-pants',
                'description' => 'Sudadera GASP acid-washed con acabado desgastado y estilo distressed. 100% algodón suave con cintura ajustable y bolsillos con cierre. Logo minimalista en cadera izquierda. Importada desde USA.',
                'price_usd'   => 9900, // $99.00 USD
                'sizes'       => ['XS/S','S/R','M/R','L/R','XL/R','XXL/R'],
                'images'      => [
                    '/img/products/gasp/washed-baggy-1.jpg',
                    '/img/products/gasp/washed-baggy-2.jpg',
                    '/img/products/gasp/washed-baggy-3.jpg',
                ],
                'category_id' => $panHombre?->id,
                'hauled_line' => 'originals',
                'stock'       => 1,
            ],
            [
                'title'       => 'GASP Ribbed T-back',
                'slug'        => 'gasp-ribbed-tback',
                'description' => 'Tank top GASP de tela acanalada con bordes raw y print frontal. Material 95% Cotton / 5% Lycra para máximo stretch y definición. Fit ajustado que resalta la musculatura. Importado desde USA.',
                'price_usd'   => 4400, // $44.00 USD
                'sizes'       => ['S', 'M', 'L', 'XL', 'XXL', '3XL', '4XL'],
                'images'      => [
                    '/img/products/gasp/ribbed-tback-1.jpg',
                    '/img/products/gasp/ribbed-tback-2.jpg',
                    '/img/products/gasp/ribbed-tback-3.jpg',
                ],
                'category_id' => $camHombre?->id,
                'hauled_line' => 'originals',
                'stock'       => 1,
            ],
            [
                'title'       => 'GASP Legacy Gym Tee',
                'slug'        => 'gasp-legacy-gym-tee',
                'description' => 'Camiseta GASP Legacy de tela suave 60% Cotton / 40% Polyester. Print en el pecho, corte regular. Diseñada para entrenar fuerte cada día con durabilidad y funcionalidad clásica GASP. Importada desde USA.',
                'price_usd'   => 2400, // $24.00 USD
                'sizes'       => ['S', 'M', 'L', 'XL', 'XXL', '3XL', '4XL'],
                'images'      => [
                    '/img/products/gasp/legacy-gym-tee-1.jpg',
                    '/img/products/gasp/legacy-gym-tee-2.jpg',
                    '/img/products/gasp/legacy-gym-tee-3.jpg',
                ],
                'category_id' => $camHombre?->id,
                'hauled_line' => 'originals',
                'stock'       => 1,
            ],
            [
                'title'       => 'GASP Two Color Iron Tee',
                'slug'        => 'gasp-two-color-iron-tee',
                'description' => 'Camiseta GASP de dos colores cosidos con efecto desgastado y grinding details. Corte holgado, tela suave bicolor 100% Cotton / 85% Cotton 15% Polyester. Diseño old school hardcore. Importada desde USA.',
                'price_usd'   => 4400, // $44.00 USD
                'sizes'       => ['S', 'M', 'L', 'XL', 'XXL', '3XL'],
                'images'      => [
                    '/img/products/gasp/two-color-tee-1.jpg',
                    '/img/products/gasp/two-color-tee-2.jpg',
                    '/img/products/gasp/two-color-tee-3.jpg',
                ],
                'category_id' => $camHombre?->id,
                'hauled_line' => 'originals',
                'stock'       => 2,
            ],
            [
                'title'       => 'GASP Core Mesh Pants',
                'slug'        => 'gasp-core-mesh-pants',
                'description' => 'Pantalón de malla transpirable GASP, estilo clásico de la marca. Tela mesh 100% Polyester con paneles laterales con logo y bolsillos con cierre. Disponible en largo Regular (R) y Largo (L). Importado desde USA.',
                'price_usd'   => 6400, // $64.00 USD
                'sizes'       => ['S/R','S/L','M/R','M/L','L/R','L/L','XL/R','XL/L','XXL/R','XXL/L'],
                'images'      => [
                    '/img/products/gasp/core-mesh-pants-1.jpg',
                    '/img/products/gasp/core-mesh-pants-2.jpg',
                    '/img/products/gasp/core-mesh-pants-3.jpg',
                ],
                'category_id' => $panHombre?->id,
                'hauled_line' => 'originals',
                'stock'       => 1,
            ],
            [
                'title'       => 'GASP Original Cut Out Tank',
                'slug'        => 'gasp-original-cutout-tank',
                'description' => 'Tank top GASP sin mangas con corte raw en las sísas para máxima exposición de hombros y espalda. Algodón pesado con print gráfico clásico. Fit holgado. Importado desde USA.',
                'price_usd'   => 3900, // $39.00 USD
                'sizes'       => ['S', 'M', 'L', 'XL', 'XXL', '3XL', '4XL'],
                'images'      => [
                    '/img/products/gasp/original-cutout-tank-1.jpg',
                    '/img/products/gasp/original-cutout-tank-2.jpg',
                    '/img/products/gasp/original-cutout-tank-3.jpg',
                ],
                'category_id' => $camHombre?->id,
                'hauled_line' => 'originals',
                'stock'       => 1,
            ],
            [
                'title'       => 'GASP Skull T-back',
                'slug'        => 'gasp-skull-tback',
                'description' => 'T-back GASP con print skull bold para máxima actitud en el gym. Algodón duradero, corte entallado que destaca la musculatura. Importado desde USA.',
                'price_usd'   => 3900, // $39.00 USD
                'sizes'       => ['S', 'M', 'L', 'XL', 'XXL', '3XL'],
                'images'      => [
                    '/img/products/gasp/skull-tback-1.jpg',
                    '/img/products/gasp/skull-tback-2.jpg',
                    '/img/products/gasp/skull-tback-3.jpg',
                ],
                'category_id' => $camHombre?->id,
                'hauled_line' => 'originals',
                'stock'       => 1,
            ],
            [
                'title'       => 'GASP Training Bag + Toalla',
                'slug'        => 'gasp-training-bag-toalla',
                'description' => 'Combo bolso de entrenamiento GASP (50L, 63×29×32cm) con múltiples compartimentos, bolsillo para ropa mojada, laterales de malla y correa desmontable — más toalla de gym GASP en terry suave con asa. Importado desde USA.',
                'price_usd'   => 7900, // $79.00 USD
                'sizes'       => ['One Size'],
                'images'      => [
                    '/img/products/gasp/training-bag-1.jpg',
                    '/img/products/gasp/training-bag-2.jpg',
                    '/img/products/gasp/training-bag-3.jpg',
                ],
                'category_id' => $accesorios?->id,
                'hauled_line' => 'originals',
                'stock'       => 1,
            ],
        ];

        foreach ($products as $data) {
            // Calcular precio COP en centavos desde centavos USD
            $data['price'] = $data['price_usd'] * self::USD_TO_COP_CENTS;
            $data['is_active'] = true;
            $data['brand_id'] = $gasp?->id;

            Product::create($data);
        }
    }
}
