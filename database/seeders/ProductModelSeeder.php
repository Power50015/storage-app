<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ProductModel::factory()->create([
            'id' => 1,
            'name' => '110 ق',
            'user_id' => 1,
            'product_collection_id' => 1
        ]);
        \App\Models\ProductModel::factory()->create([
            'id' => 2,
            'name' => '68 ق',
            'user_id' => 1,
            'product_collection_id' => 1
        ]);
    }
}
