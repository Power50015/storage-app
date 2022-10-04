<?php

namespace Database\Factories\Product;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Product\ProductCountry;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductBrand>
 */
class ProductBrandFactory extends Factory
{
    public function definition()
    {
        $faker = FakerFactory::create('ar_SA');
        $image = function () {
            $url = $this->faker->randomElement(
                [
                    Http::get('https://loremflickr.com/json/250/250/logo/all')["file"],
                    Http::get('https://loremflickr.com/json/300/300/logo/all')["file"],
                    Http::get('https://loremflickr.com/json/350/350/logo/all')["file"],
                    Http::get('https://loremflickr.com/json/400/400/logo/all')["file"],
                    Http::get('https://loremflickr.com/json/450/450/logo/all')["file"],
                    Http::get('https://loremflickr.com/json/500/500/logo/all')["file"]
                ]
            );;
            $contents = file_get_contents($url);
            $name = substr($url, strrpos($url, '/') + 1);
            Storage::put('public/image/brand/' . $name, $contents);
            return 'image/brand/' . $name;
        };
        return [
            'name' => $faker->unique()->company(),
            'logo' => $this->faker->randomElement([$image, $image, $image, $image, 'no_image.png']),
            'product_country_id' => ProductCountry::all()->random()->id,
            'user_id' => User::all()->random()->id,
        ];
    }
}
