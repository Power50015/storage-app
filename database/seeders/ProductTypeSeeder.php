<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ProductType::factory()->create([
            'name' => 'أطقم صينى سفره',
            'product_categories' => 1,
            'user' => 1,
        ]);
        \App\Models\ProductType::factory()->create([
            'name' => 'أطقم شاى',
            'product_categories' => 1,
            'user' => 1,
        ]);
        \App\Models\ProductType::factory()->create([
            'name' => 'أطقم عشاء',
            'product_categories' => 1,
            'user' => 1,
        ]);
        \App\Models\ProductType::factory()->create([
            'name' => 'أطقم أيس كريم',
            'product_categories' => 1,
            'user' => 1,
        ]);
        \App\Models\ProductType::factory()->create([
            'name' => 'أطقم بولات',
            'product_categories' => 1,
            'user' => 1,
        ]);
        \App\Models\ProductType::factory()->create([
            'name' => 'طقم سلطانيه بالبولات',
            'product_categories' => 1,
            'user' => 1,
        ]);
        \App\Models\ProductType::factory()->create([
            'name' => 'طنيه كاب كيك',
            'product_categories' => 2,
            'user' => 1,
        ]);
    }
}
