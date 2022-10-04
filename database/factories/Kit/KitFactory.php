<?php

namespace Database\Factories\Kit;

use App\Models\Product\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Null_;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kit>
 */
class KitFactory extends Factory
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
                    Http::get('https://loremflickr.com/json/1200/1200/product/all')["file"],
                    Http::get('https://loremflickr.com/json/1500/1500/product/all')["file"],
                    Http::get('https://loremflickr.com/json/1550/1550/kit/all')["file"],
                    Http::get('https://loremflickr.com/json/2000/2000/product/all')["file"],
                    Http::get('https://loremflickr.com/json/680/680/kit/all')["file"],
                    Http::get('https://loremflickr.com/json/750/750/product/all')["file"]
                ]
            );
            $contents = file_get_contents($url);
            $name = substr($url, strrpos($url, '/') + 1);
            Storage::put('public/image/kit/' . $name, $contents);
            return 'image/kit/' . $name;
        };
        return [
            'title' => $faker->unique()->word(),
            'description' => $faker->unique()->text(),
            'image' => $image,
            'user_id' => User::all()->random()->id,
            'product_id' => $this->faker->randomElement(
                [
                    Product::all()->random()->id,
                    Null
                ]
            )
        ];
    }
}
