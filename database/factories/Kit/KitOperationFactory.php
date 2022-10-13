<?php

namespace Database\Factories\Kit;

use App\Models\Kit\Kit;
use App\Models\User;
use App\Models\Warehouse\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KitOperation>
 */
class KitOperationFactory extends Factory
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
            'action' => $this->faker->randomElement([0, 1]),
            'date' => $faker->dateTimeBetween('-10 days', now()),
            'quantity' => $faker->numberBetween($min = 1, $max = 5),
            'kit_id' => $faker->unique()->randomElement(Kit::all('id')),
            'warehouse_id' => $faker->unique()->randomElement(Warehouse::all('id')),
            'user_id' => $faker->unique()->randomElement(User::all('id')),
        ];
    }
}
