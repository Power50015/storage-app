<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Product::factory()->create([
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
            'image' => 'image/product/eRUOWKrzgjkgr3kO10tP45OpINauyKWXguYHhxRB.jpg',
            'user_id' => 1,
            'description' => '<ul><li>12 x طبق عشاء27سم</li><li>12 x طبق حلو 20سم</li><li>12 x طبق غويط شوربه 22 سم</li><li>12 x بوله 14سم</li><li>12 x فنجان شاى&nbsp;</li><li>12 x طبق شاى 16سم</li><li>12 x فنجان قهوه</li><li>12 x طبق قهوه 12سم</li><li>2 x طبق تقديم 23سم</li><li>2 x طبق تقديم كبير 34سم</li><li>1 x بوله سلطه 24سم</li><li>1 x لبانه</li><li>1 x ملاحه</li><li>1 x فلفل</li><li>1 x براد شاى + غطاء&nbsp;</li><li>1 x سلطانيه + غطاء</li><li>1 x سكريه + غطاء</li></ul>',
        ]);
        \App\Models\Product::factory()->create([
            'product_category_id' => 1,
            'product_type_id' => 1,
            'product_brand_id' => 1,
            'product_collection_id' => 1,
            'product_model_id' => 2,
            'name' => 'سلسلبيل ',
            'product_color_id' => 1,
            'product_material_id' => 1,
            'sku' => 'GA703HA0TLHGON',
            'product_country_id' => 1,
            'image' => 'image/product/rlkgjklfdldjgl543523.jpg',
            'user_id' => 1,
            'description' => '<ul><li>6 x طبق عشاء27سم</li><li>6 x طبق 15 سم</li><li>6 x طبق حلو 20سم</li><li>6 x طبق غويط شوربه 22 سم</li><li>6 x بوله 14سم</li><li>6 x فنجان شاى&nbsp;</li><li>6 x طبق شاى 16سم</li><li>6 x فنجان قهوه</li><li>6 x طبق قهوه 12سم</li><li>2 x طبق تقديم 23سم</li><li>1 x طبق تقديم كبير 34سم</li><li>1 x سرفيس 30سم</li><li>1 x بوله سلطه 24سم</li><li>1 x لبانه</li><li>1 x ملاحه</li><li>1 x فلفل</li><li>1 x براد شاى + غطاء&nbsp;</li><li>1 x سلطانيه + غطاء</li><li>1 x سكريه + غطاء</li></ul>',
        ]);
    }
}
