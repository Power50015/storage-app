<?php

namespace Database\Factories\Product;

use App\Models\Product\ProductBrand;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductCollection;
use App\Models\Product\ProductColor;
use App\Models\Product\ProductCountry;
use App\Models\Product\ProductMaterial;
use App\Models\Product\ProductModel;
use App\Models\Product\ProductType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
                    Http::get('https://loremflickr.com/json/1550/1550/product/all')["file"],
                    Http::get('https://loremflickr.com/json/2000/2000/product/all')["file"],
                    Http::get('https://loremflickr.com/json/680/680/product/all')["file"],
                    Http::get('https://loremflickr.com/json/750/750/product/all')["file"]
                ]
            );
            $contents = file_get_contents($url);
            $name = substr($url, strrpos($url, '/') + 1);
            Storage::put('public/image/product/' . $name, $contents);
            return 'image/product/' . $name;
        };
        return [
            'product_category_id' => ProductCategory::all()->random()->id,
            'product_type_id' => ProductType::all()->random()->id,
            'product_brand_id' => ProductBrand::all()->random()->id,
            'product_collection_id' => ProductCollection::all()->random()->id,
            'product_model_id' => ProductModel::all()->random()->id,
            'name' => $faker->unique()->word(),
            'product_color_id' => ProductColor::all()->random()->id,
            'product_material_id' => ProductMaterial::all()->random()->id,
            'sku' => $faker->unique()->creditCardNumber(),
            'product_country_id' => ProductCountry::all()->random()->id,
            'image' => $image,
            'user_id' => User::all()->random()->id,
            'description' => $faker->unique()->text(),
            'price' => $faker->unique()->numberBetween($min = 100, $max = 9000),
        ];
    }
}
