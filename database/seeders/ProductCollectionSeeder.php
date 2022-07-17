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
            'user' => 1,
            'product_brand' => 1
        ]);
        \App\Models\ProductCollection::factory()->create([
            'id' => 2,
            'name' => 'الإمبراطور',
            'user' => 1,
            'product_brand' => 1
        ]);
    }
}
