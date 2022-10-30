<?php

namespace Database\Factories\Product;

use App\Models\Product\Product;
use App\Models\User;
use App\Models\Warehouse\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product\DestructibleGoods>
 */
class DestructibleGoodsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = FakerFactory::create('ar_SA');
        return [
            'product_id' => $faker->unique()->randomElement(Product::all('id')),
            'warehouse_id' => $faker->unique()->randomElement(Warehouse::all('id')),
            'user_id' => $faker->unique()->randomElement(User::all('id')),
        ];
    }
}
