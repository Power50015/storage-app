<?php

namespace Database\Factories\Transfer;

use App\Models\Driver\Driver;
use App\Models\User;
use App\Models\Warehouse\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transfer>
 */
class TransferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = FakerFactory::create('ar_SA');
        $driver = $faker->randomElement(
            [
                0, 1
            ]
        );
        $from = Warehouse::all()->random()->id;
        $to = 0;
        do {
            $to = Warehouse::all()->random()->id;
        } while ($to != $from);
        return [
            'name' => $faker->unique()->name(),
            'date' => $faker->dateTimeBetween('-400 days', now()),
            'driver_id' => $driver == 1 ?  Driver::all()->random()->id : null,
            'user_id' => User::all()->random()->id,
            'warehouse_from_id' => Warehouse::all()->random()->id,
            'warehouse_to_id' => Warehouse::all()->random()->id,
        ];
    }
}
