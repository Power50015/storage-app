<?php

namespace Database\Factories\Creditor;

use App\Models\Cash\Cash;
use App\Models\People\People;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CreditorPay>
 */
class CreditorPayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = FakerFactory::create('ar_SA');
        $pay = $faker->randomElement(
            [
                0, 1
            ]
        );
        return [
            'title' => $faker->unique()->word(),
            'description' => $faker->unique()->word(),
            'date' => $faker->dateTimeBetween('-400 days', now()),
            'amount' => $faker->unique()->numberBetween($min = 3000, $max = 250000),
            'people_id' => People::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'pay_type' => $pay,
            'cash_id' => $pay == 1 ? Cash::all()->random()->id : null,
        ];
    }
}
