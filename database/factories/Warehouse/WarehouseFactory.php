<?php

namespace Database\Factories\Warehouse;

use App\Models\User;
use Faker\Factory as FakerFactory;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Warehouse>
 */
class WarehouseFactory extends Factory
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
            'name' => $this->faker->unique()->randomElement(
                [
                    $faker->unique()->city(),
                    $faker->unique()->firstNameMale(),
                    $faker->unique()->firstNameFemale(),
                    $faker->unique()->firstNameFemale()
                ]
            ),
            'address' => $faker->unique()->address(),
            'user_id' => User::all()->random()->id,
        ];
    }
}
