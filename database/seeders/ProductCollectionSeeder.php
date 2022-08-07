<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ProductCollection::factory()->create([
            'id' => 1,
            'name' => 'لى لى',
            'user_id' => 1,
            'product_brand_id' => 1
        ]);
        \App\Models\ProductCollection::factory()->create([
            'id' => 2,
            'name' => 'الإمبراطور',
            'user_id' => 1,
            'product_brand_id' => 1
        ]);
        \App\Models\ProductCollection::factory()->create([
            'id' => 3,
            'name' => 'جلاكسي',
            'user_id' => 1,
            'product_brand_id' => 1
        ]);
        \App\Models\ProductCollection::factory()->create([
            'id' => 4,
            'name' => 'تريد لاين',
            'user_id' => 1,
            'product_brand_id' => 6
        ]);
        \App\Models\ProductCollection::factory()->create([
            'id' => 5,
            'name' => 'جرانيت',
            'user_id' => 1,
            'product_brand_id' => 6
        ]);
    }
}
