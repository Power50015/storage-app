<?php

namespace Database\Factories\Kit;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KitImage>
 */
class KitImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $image = function () {
            $url =  Http::get('https://loremflickr.com/json/500/500/product/all')["file"];

            $contents = file_get_contents($url);
            $name = substr($url, strrpos($url, '/') + 1);
            Storage::put('public/image/kit/' . $name, $contents);
            return 'image/kit/' . $name;
        };
        return [
            'image' => $image,
            'user_id' => User::all()->random()->id,
        ];
    }
}
