<?php

namespace Database\Seeders\Product;

use App\Models\Product\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();
        Storage::deleteDirectory('public/image/product');
        Product::factory()->create([
            'product_category_id' => 1,
            'product_type_id' => 1,
            'product_brand_id' => 1,
            'product_collection_id' => 1,
            'product_model_id' => 1,
            'name' => 'أنجلينا',
            'product_color_id' => 1,
            'product_material_id' => 1,
            'sku' => 'FA703HA0TLHGONAFAMZ',
            'product_country_id' => 1,
            'image' => function () {
                $url = "https://eg.jumia.is/unsafe/fit-in/680x680/filters:fill(white)/product/83/032882/1.jpg";
                $contents = file_get_contents($url);
                $name = substr($url, strrpos($url, '/') + 1);
                Storage::put('public/image/product/' . $name, $contents);
                return 'image/product/' . $name;
            },
            'user_id' => User::all()->random()->id,
            'description' => '<ul><li>12 x طبق عشاء27سم</li><li>12 x طبق حلو 20سم</li><li>12 x طبق غويط شوربه 22 سم</li><li>12 x بوله 14سم</li><li>12 x فنجان شاى&nbsp;</li><li>12 x طبق شاى 16سم</li><li>12 x فنجان قهوه</li><li>12 x طبق قهوه 12سم</li><li>2 x طبق تقديم 23سم</li><li>2 x طبق تقديم كبير 34سم</li><li>1 x بوله سلطه 24سم</li><li>1 x لبانه</li><li>1 x ملاحه</li><li>1 x فلفل</li><li>1 x براد شاى + غطاء&nbsp;</li><li>1 x سلطانيه + غطاء</li><li>1 x سكريه + غطاء</li></ul>',
            'price' => 5500,
        ]);
        Product::factory()->create([
            'product_category_id' => 1,
            'product_type_id' => 1,
            'product_brand_id' => 1,
            'product_collection_id' => 1,
            'product_model_id' => 2,
            'name' => 'راينى  ',
            'product_color_id' => 1,
            'product_material_id' => 1,
            'sku' => 'GA703HA0TLHGON',
            'product_country_id' => 1,
            'image' => function () {
                $url = "https://eg.jumia.is/unsafe/fit-in/680x680/filters:fill(white)/product/30/229072/4.jpg";
                $contents = file_get_contents($url);
                $name = substr($url, strrpos($url, '/') + 1);
                Storage::put('public/image/product/' . $name, $contents);
                return 'image/product/' . $name;
            },
            'user_id' => User::all()->random()->id,
            'description' => '<ul><li>6 x طبق عشاء27سم</li><li>6 x طبق 15 سم</li><li>6 x طبق حلو 20سم</li><li>6 x طبق غويط شوربه 22 سم</li><li>6 x بوله 14سم</li><li>6 x فنجان شاى&nbsp;</li><li>6 x طبق شاى 16سم</li><li>6 x فنجان قهوه</li><li>6 x طبق قهوه 12سم</li><li>2 x طبق تقديم 23سم</li><li>1 x طبق تقديم كبير 34سم</li><li>1 x سرفيس 30سم</li><li>1 x بوله سلطه 24سم</li><li>1 x لبانه</li><li>1 x ملاحه</li><li>1 x فلفل</li><li>1 x براد شاى + غطاء&nbsp;</li><li>1 x سلطانيه + غطاء</li><li>1 x سكريه + غطاء</li></ul>',
            'price' => 6000,
        ]);
        Product::factory(25)->create();
        Product::factory(25)->create();
        Product::factory(25)->create();
        Product::factory(25)->create();
        Product::factory(25)->create();
        Product::factory(25)->create();
        Product::factory(25)->create();
        Product::factory(25)->create();
        Product::factory(25)->create();
        Product::factory(25)->create();
        Product::factory(25)->create();
        Product::factory(25)->create();
        Product::factory(25)->create();
        Product::factory(25)->create();
        Product::factory(25)->create();
        Product::factory(25)->create();
        Product::factory(25)->create();
        Product::factory(25)->create();
        Product::factory(25)->create();
        Product::factory(25)->create();
        Product::factory(25)->create();
        Product::factory(25)->create();
        Product::factory(25)->create();
        Product::factory(25)->create();
    }
}
