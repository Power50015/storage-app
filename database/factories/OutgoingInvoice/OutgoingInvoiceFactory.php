<?php

namespace Database\Factories\OutgoingInvoice;

use App\Models\Cash\Cash;
use App\Models\People\People;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;
use App\Models\User;
use App\Models\Warehouse\Warehouse;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OutgoingInvoice>
 */
class OutgoingInvoiceFactory extends Factory
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
            'pay_type' => $pay,
            'discount' => 0,
            'date' => $faker->dateTimeBetween('-400 days', now()),
            'cash_id' => $pay == 1 ?  Cash::all()->random()->id : null,
            'user_id' => User::all()->random()->id,
            'people_id' => People::all()->random()->id,
            'warehouse_id' => Warehouse::all()->random()->id,
        ];
    }
}
