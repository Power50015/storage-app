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
            'user_id' => 1,
        ]);
        \App\Models\ProductMaterial::factory()->create([
            'name' => 'سيراميك',
            'user_id' => 1,
        ]);
        \App\Models\ProductMaterial::factory()->create([
            'name' => 'بلاستيك',
            'user_id' => 1,
        ]);
        \App\Models\ProductMaterial::factory()->create([
            'name' => 'سليكون',
            'user_id' => 1,
        ]);
        \App\Models\ProductMaterial::factory()->create([
            'name' => 'زجاج',
            'user_id' => 1,
        ]);
        \App\Models\ProductMaterial::factory()->create([
            'name' => 'استليس',
            'user_id' => 1,
        ]);
        \App\Models\ProductMaterial::factory()->create([
            'name' => 'بيركس',
            'user_id' => 1,
        ]);
    }
}
