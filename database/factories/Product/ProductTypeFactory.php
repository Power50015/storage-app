<?php

namespace Database\Factories\Product;

use App\Models\Product\ProductCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductType>
 */
class ProductTypeFactory extends Factory
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
            'product_category_id' => ProductCategory::all()->random()->id,
            'user_id' => User::all()->random()->id,
        ];
    }
}
