<?php

namespace Database\Factories\Product;

use App\Models\Product\ProductBrand;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductCollection>
 */
class ProductCollectionFactory extends Factory
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
            'name' => $faker->unique()->name(),
            'user_id' => User::all()->random()->id,
            'product_brand_id' => ProductBrand::all()->random()->id,
        ];
    }
}
