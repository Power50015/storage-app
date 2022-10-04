<?php

namespace Database\Seeders\Product;

use App\Models\Product\ProductCountry;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductCountry::truncate();
        ProductCountry::create([
            'id' => 1,
            'name' => 'مصر',
            'user_id' => User::all()->random()->id,
        ]);
        ProductCountry::factory(100)->create();
    }
}
