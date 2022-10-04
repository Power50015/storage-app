<?php

namespace Database\Seeders\Product;

use App\Models\Product\ProductBrand;
use App\Models\Product\ProductCountry;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductBrand::truncate();
        Storage::deleteDirectory('public/image/brand');
        ProductBrand::factory()->create([
            'name' => 'فتحى محمود',
            'logo' => function () {
                $url = "https://egyptianporcelain-fm.com/wp-content/uploads/2020/04/logo.png";
                $contents = file_get_contents($url);
                $name = substr($url, strrpos($url, '/') + 1);
                Storage::put('public/image/brand/' . $name, $contents);
                return 'image/brand/' . $name;
            },
            'product_country_id' => 1,
            'user_id' => User::all()->random()->id,
        ]);
        ProductBrand::factory()->create([
            'name' => 'تورنيدو',
            'logo' => function () {
                $url = "https://m.media-amazon.com/images/S/aplus-media/sota/9a1b8abe-ab70-4a01-89fb-1e6d212b3971.__CR0,0,970,300_PT0_SX970_V1___.jpg";
                $contents = file_get_contents($url);
                $name = substr($url, strrpos($url, '/') + 1);
                Storage::put('public/image/brand/' . $name, $contents);
                return 'image/brand/' . $name;
            },
            'product_country_id' => ProductCountry::all()->random()->id,
            'user_id' => User::all()->random()->id,
        ]);
        ProductBrand::factory()->create([
            'name' => 'سونى',
            'logo' => function () {
                $url = "https://upload.wikimedia.org/wikipedia/commons/thumb/c/ca/Sony_logo.svg/2560px-Sony_logo.svg.png";
                $contents = file_get_contents($url);
                $name = substr($url, strrpos($url, '/') + 1);
                Storage::put('public/image/brand/' . $name, $contents);
                return 'image/brand/' . $name;
            },
            'product_country_id' => ProductCountry::all()->random()->id,
            'user_id' => User::all()->random()->id,
        ]);
        ProductBrand::factory()->create([
            'name' => 'مديا تك',
            'logo' => function () {
                $url = "https://upload.wikimedia.org/wikipedia/commons/thumb/b/bf/Midea.svg/280px-Midea.svg.png";
                $contents = file_get_contents($url);
                $name = substr($url, strrpos($url, '/') + 1);
                Storage::put('public/image/brand/' . $name, $contents);
                return 'image/brand/' . $name;
            },
            'product_country_id' => ProductCountry::all()->random()->id,
            'user_id' => User::all()->random()->id,
        ]);
        ProductBrand::factory()->create([
            'name' => 'فلارى اند بوخ',
            'logo' => 'no_image.png',
            'product_country_id' => ProductCountry::all()->random()->id,
            'user_id' => User::all()->random()->id,
        ]);
        ProductBrand::factory()->create([
            'name' => 'فريش',
            'logo' => 'no_image.png',
            'product_country_id' => ProductCountry::all()->random()->id,
            'user_id' => User::all()->random()->id,
        ]);
        ProductBrand::create([
            'name' => 'سوكانى',
            'logo' => 'no_image.png',
            'product_country_id' => ProductCountry::all()->random()->id,
            'user_id' => User::all()->random()->id,
        ]);
        ProductBrand::factory()->create([
            'name' => 'تيفال',
            'logo' => function () {
                $url = "https://cairocart.com/pub/media/codazon_cache/brand/1200x/Manufacturer/index.png";
                $contents = file_get_contents($url);
                $name = substr($url, strrpos($url, '/') + 1);
                Storage::put('public/image/brand/' . $name, $contents);
                return 'image/brand/' . $name;
            },
            'product_country_id' => ProductCountry::all()->random()->id,
            'user_id' => User::all()->random()->id,
        ]);
        ProductBrand::factory()->create([
            'name' => 'تروفال',
            'logo' => 'no_image.png',
            'product_country_id' => ProductCountry::all()->random()->id,
            'user_id' => User::all()->random()->id,
        ]);
        ProductBrand::create([
            'name' => 'زينوكس',
            'logo' => 'no_image.png',
            'product_country_id' => ProductCountry::all()->random()->id,
            'user_id' => User::all()->random()->id,
        ]);
        ProductBrand::factory(15)->create();
        ProductBrand::factory(15)->create();
        ProductBrand::factory(15)->create();
        ProductBrand::factory(15)->create();
        ProductBrand::factory(15)->create();
        ProductBrand::factory(15)->create();
        ProductBrand::factory(15)->create();
        ProductBrand::factory(15)->create();
        ProductBrand::factory(15)->create();
        ProductBrand::factory(15)->create();
        ProductBrand::factory(15)->create();
    }
}
