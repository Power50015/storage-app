<?php

namespace Database\Seeders\Kit;

use App\Models\Kit\Kit;
use App\Models\Product\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class KitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kit::truncate();
        Storage::deleteDirectory('public/image/kit');
        Kit::factory()->create([
            'title' => "طبق مدور",
            'description' => "",
            'image' => function () {
                $url = "https://eg.jumia.is/unsafe/fit-in/680x680/filters:fill(white)/product/23/264172/4.jpg";
                $contents = file_get_contents($url);
                $name = substr($url, strrpos($url, '/') + 1);
                Storage::put('public/image/kit/' . $name, $contents);
                return 'image/kit/' . $name;
            },
            'user_id' => User::all()->random()->id,
            'product_id' => Product::all()->random()->id,
        ]);
        Kit::factory()->create([
            'title' => "فنجان",
            'description' => "",
            'image' => function () {
                $url = "https://villeroyboch-egypt.com/wp-content/uploads/1035041420neu.jpg";
                $contents = file_get_contents($url);
                $name = substr($url, strrpos($url, '/') + 1);
                Storage::put('public/image/kit/' . $name, $contents);
                return 'image/kit/' . $name;
            },
            'user_id' => User::all()->random()->id,
            'product_id' => Product::all()->random()->id,
        ]);
        Kit::factory(10)->create();
        Kit::factory(10)->create();
        Kit::factory(10)->create();
        Kit::factory(10)->create();
        Kit::factory(10)->create();
        Kit::factory(10)->create();
        Kit::factory(10)->create();

    }
}
