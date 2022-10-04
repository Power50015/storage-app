<?php

namespace Database\Seeders\Product;

use App\Models\Product\ProductModel;
use App\Models\User;
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
        ProductModel::truncate();
        ProductModel::create([
            'name' => '110 ق',
            'user_id' => User::all()->random()->id,
            'product_collection_id' => 1
        ]);
        ProductModel::create([
            'name' => '68 ق',
            'user_id' => User::all()->random()->id,
            'product_collection_id' => 1
        ]);
        ProductModel::factory(800)->create();
    }
}
