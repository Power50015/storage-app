<?php

namespace Database\Factories\Product;;

use App\Models\Product\ProductCollection;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductModel>
 */
class ProductModelFactory extends Factory
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
            'product_collection_id' => ProductCollection::all()->random()->id,
        ];
    }
}
