<?php

namespace Database\Factories\Warehouse;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WarehouseStockContent>
 */
class WarehouseStockContentFactory extends Factory
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
            'quantity' => $faker->numberBetween($min = 1, $max = 100),
            'product_id' => $faker->unique()->randomElement(Product::all('id')) //Product::all()->random()->id
        ];
    }
}
