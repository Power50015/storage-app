<?php

namespace Database\Seeders\Product;

use App\Models\Product\ProductCollection;
use App\Models\User;
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
        ProductCollection::truncate();
        ProductCollection::factory()->create([
            'name' => 'لى لى',
            'user_id' => User::all()->random()->id,
            'product_brand_id' => 1
        ]);
        ProductCollection::factory()->create([
            'name' => 'الإمبراطور',
            'user_id' => User::all()->random()->id,
            'product_brand_id' => 1
        ]);
        ProductCollection::factory()->create([
            'name' => 'جلاكسي',
            'user_id' => User::all()->random()->id,
            'product_brand_id' => 1
        ]);
        ProductCollection::factory()->create([
            'name' => 'تريد لاين',
            'user_id' => User::all()->random()->id,
            'product_brand_id' => 6
        ]);
        ProductCollection::factory()->create([
            'name' => 'جرانيت',
            'user_id' => User::all()->random()->id,
            'product_brand_id' => 6
        ]);
        ProductCollection::factory(800)->create();
    }
}
