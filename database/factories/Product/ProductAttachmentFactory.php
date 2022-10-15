<?php

namespace Database\Factories\Product;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductAttachment>
 */
class ProductAttachmentFactory extends Factory
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
            $url =  Http::get('https://loremflickr.com/json/500/500/product/all')["file"];
            $contents = file_get_contents($url);
            $name = substr($url, strrpos($url, '/') + 1);
            Storage::put('public/attachment/product/' . $name, $contents);
            return 'attachment/kit/' . $name;
        };
        return [
            'title' => $faker->unique()->name,
            'attachment' => $image,
            'user_id' => User::all()->random()->id,
        ];
    }
}
