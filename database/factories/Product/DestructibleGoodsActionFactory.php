<?php

namespace Database\Factories\Product;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product\DestructibleGoodsAction>
 */
class DestructibleGoodsActionFactory extends Factory
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
            'title' => $faker->unique()->word(),
            'description' => $faker->unique()->text(),
            'action' => $this->faker->randomElement([0, 1, 2]),
            'date' => $faker->dateTimeBetween('-10 days', now()),
        ];
    }
}
