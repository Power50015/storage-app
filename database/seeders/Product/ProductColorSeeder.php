<?php

namespace Database\Seeders\Product;

use App\Models\Product\ProductColor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductColor::truncate();
        ProductColor::create([
            'name' => 'إيفورى',
            'user_id' => User::all()->random()->id,
        ]);
        ProductColor::create([
            'name' => 'أحمر و أبيض',
            'user_id' => User::all()->random()->id,
        ]);
        ProductColor::create([
            'name' => 'إيفورى و دهب',
            'user_id' => User::all()->random()->id,
        ]);
        ProductColor::create([
            'name' => 'أبيض و دهب',
            'user_id' => User::all()->random()->id,
        ]);
        ProductColor::factory(80)->create();
    }
}
