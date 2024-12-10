<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Mercedes-Benz Clase E',
                'description' => 'Un sedán de lujo con tecnología avanzada.',
                'category_id' => 1,
            ],
            [
                'name' => 'Corsa Evolution',
                'description' => 'Corsa Evolution de 5 puertas.',
                'category_id' => 2,
            ],
        ];

        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'description' => $product['description'],
                'category_id' => $product['category_id'],
                // Se genera automáticamente desde el modelo, pero si no:
                'slug' => Str::slug($product['name']),
            ]);
        }
    }
}

