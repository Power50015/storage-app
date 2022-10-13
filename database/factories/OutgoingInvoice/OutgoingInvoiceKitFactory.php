<?php

namespace Database\Factories\OutgoingInvoice;

use App\Models\Kit\Kit;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OutgoingInvoice\OutgoingInvoiceKit>
 */
class OutgoingInvoiceKitFactory extends Factory
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
            'quantity' => $faker->numberBetween($min = 1, $max = 100),
            'price' => $faker->numberBetween($min = 15, $max = 200),
            'kit_id' => $faker->unique()->randomElement(Kit::all('id'))
        ];
    }
}
