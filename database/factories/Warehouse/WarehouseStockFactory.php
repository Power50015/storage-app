<?php

namespace Database\Factories\Warehouse;

use App\Models\User;
use App\Models\Warehouse\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WarehouseStock>
 */
class WarehouseStockFactory extends Factory
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
            'title' => $faker->word(),
            'date' => $faker->dateTimeBetween('-400 days', now()),
            'user_id' => User::all()->random()->id,
            'warehouse_id' => Warehouse::all()->random()->id,
        ];
    }
}
