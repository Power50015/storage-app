<?php

namespace Database\Factories\Product;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Faker\Factory as FakerFactory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductCountry>
 */
class ProductCountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = FakerFactory::create('ar_SA');
        $name = "";
        do {
            $name =  $faker->unique()->country();
        } while ($name == 'مصر');
        return [
            'name' =>  $name,
            'user_id' => User::all()->random()->id,
        ];
    }
}
