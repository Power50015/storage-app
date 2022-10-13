<?php

namespace Database\Factories\Driver;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Driver>
 */
class DriverFactory extends Factory
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
            'phone' => $this->faker->randomElement(['012', '011', '010', '015']) . $this->faker->unique()->randomNumber($nbDigits = 8),
            'user_id' => User::all()->random()->id,
        ];
    }
}
