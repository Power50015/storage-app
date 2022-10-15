<?php

namespace Database\Factories\Product;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductNote>
 */
class ProductNoteFactory extends Factory
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
            'user_id' => User::all()->random()->id,
            'tag' => $faker->unique()->word(),
            'note' => $faker->unique()->text(),
        ];
    }
}
