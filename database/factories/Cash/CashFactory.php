<?php

namespace Database\Factories\Cash;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cash>
 */
class CashFactory extends Factory
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
            'title' => "حساب بنك رقم ". $faker->unique()->bankAccountNumber(),
            'user_id' => User::all()->random()->id,
        ];
    }
}
