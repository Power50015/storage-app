<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ProductMaterial::factory()->create([
            'name' => 'بروسلين',
            'user' => 1,
        ]);
        \App\Models\ProductMaterial::factory()->create([
            'name' => 'سيراميك',
            'user' => 1,
        ]);
        \App\Models\ProductMaterial::factory()->create([
            'name' => 'بلاستيك',
            'user' => 1,
        ]);
        \App\Models\ProductMaterial::factory()->create([
            'name' => 'سليكون',
            'user' => 1,
        ]);
        \App\Models\ProductMaterial::factory()->create([
            'name' => 'زجاج',
            'user' => 1,
        ]);
        \App\Models\ProductMaterial::factory()->create([
            'name' => 'استليس',
            'user' => 1,
        ]);
        \App\Models\ProductMaterial::factory()->create([
            'name' => 'بيركس',
            'user' => 1,
        ]);
    }
}
