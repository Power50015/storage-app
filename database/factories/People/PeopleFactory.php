<?php

namespace Database\Factories\People;

use App\Models\User;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\People>
 */
class PeopleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $faker = FakerFactory::create('ar_SA');
        $image = function () {
            $url = $this->faker->randomElement(
                [
                    Http::get('https://loremflickr.com/json/100/100/logo/all')["file"],
                    Http::get('https://loremflickr.com/json/150/150/logo/all')["file"],
                    Http::get('https://loremflickr.com/json/50/50/logo/all')["file"],
                    Http::get('https://loremflickr.com/json/200/200/logo/all')["file"]
                ]
            );;
            $contents = file_get_contents($url);
            $name = substr($url, strrpos($url, '/') + 1);
            Storage::put('public/image/people/' . $name, $contents);
            return 'image/people/' . $name;
        };
        return [
            'name' => $faker->unique()->company(),
            'phone' => $this->faker->randomElement(['012', '011', '010', '015']) . $this->faker->unique()->randomNumber($nbDigits = 8),
            'logo' => $this->faker->randomElement([$image, $image, $image, $image, 'no_image.png']),
            "address" => $faker->address(),
            'type' => $this->faker->randomElement(['مورد', 'عميل']),
            'user_id' => User::all()->random()->id,
        ];
    }
}
