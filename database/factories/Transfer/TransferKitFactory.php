<?php

namespace Database\Factories\Transfer;

use App\Models\Kit\Kit;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transfer\TransferKit>
 */
class TransferKitFactory extends Factory
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
            'kit_id' => $faker->unique()->randomElement(Kit::all('id'))
        ];
    }
}
