<?php

namespace Database\Seeders\Product;

use App\Models\Product\ProductMaterial;
use App\Models\User;
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
        ProductMaterial::create([
            'name' => 'بروسلين',
            'user_id' => User::all()->random()->id,
        ]);
        ProductMaterial::create([
            'name' => 'سيراميك',
            'user_id' => User::all()->random()->id,
        ]);
        ProductMaterial::create([
            'name' => 'بلاستيك',
            'user_id' => User::all()->random()->id,
        ]);
        ProductMaterial::create([
            'name' => 'سليكون',
            'user_id' => User::all()->random()->id,
        ]);
        ProductMaterial::create([
            'name' => 'زجاج',
            'user_id' => User::all()->random()->id,
        ]);
        ProductMaterial::create([
            'name' => 'استليس',
            'user_id' => User::all()->random()->id,
        ]);
        ProductMaterial::create([
            'name' => 'بيركس',
            'user_id' => User::all()->random()->id,
        ]);
        ProductMaterial::factory(100)->create();
    }
}
