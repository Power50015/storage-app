<?php

namespace Database\Seeders\Product;

use App\Models\Product\ProductType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductType::truncate();
        ProductType::factory()->create([
            'name' => 'أطقم صينى سفره',
            'product_category_id' => 1,
            'user_id' => User::all()->random()->id,
        ]);
        ProductType::factory()->create([
            'name' => 'أطقم شاى',
            'product_category_id' => 1,
            'user_id' => User::all()->random()->id,
        ]);
        ProductType::factory()->create([
            'name' => 'أطقم عشاء',
            'product_category_id' => 1,
            'user_id' => User::all()->random()->id,
        ]);
        ProductType::factory()->create([
            'name' => 'أطقم أيس كريم',
            'product_category_id' => 1,
            'user_id' => User::all()->random()->id,
        ]);
        ProductType::factory()->create([
            'name' => 'أطقم بولات',
            'product_category_id' => 1,
            'user_id' => User::all()->random()->id,
        ]);
        ProductType::factory()->create([
            'name' => 'طقم سلطانيه بالبولات',
            'product_category_id' => 1,
            'user_id' => User::all()->random()->id,
        ]);
        ProductType::factory()->create([
            'name' => 'صنيه كاب كيك',
            'product_category_id' => 2,
            'user_id' => User::all()->random()->id,
        ]);
        ProductType::factory()->create([
            'name' => 'صنيه خبز',
            'product_category_id' => 2,
            'user_id' => User::all()->random()->id,
        ]);
        ProductType::factory()->create([
            'name' => 'تزين كيكه',
            'product_category_id' => 2,
            'user_id' => User::all()->random()->id,
        ]);
        ProductType::factory()->create([
            'name' => 'طقم سكاكين',
            'product_category_id' => 3,
            'user_id' => User::all()->random()->id,
        ]);
        ProductType::factory()->create([
            'name' => 'سكينه شيف',
            'product_category_id' => 3,
            'user_id' => User::all()->random()->id,
        ]);
        ProductType::factory()->create([
            'name' => 'سكين خبز',
            'product_category_id' => 3,
            'user_id' => User::all()->random()->id,
        ]);
        ProductType::factory()->create([
            'name' => 'مسن سكاكين',
            'product_category_id' => 4,
            'user_id' => User::all()->random()->id,
        ]);
        ProductType::factory()->create([
            'name' => 'خلاط',
            'product_category_id' => 4,
            'user_id' => User::all()->random()->id,
        ]);
        ProductType::factory()->create([
            'name' => 'عجان',
            'product_category_id' => 4,
            'user_id' => User::all()->random()->id,
        ]);
        ProductType::factory()->create([
            'name' => 'مضرب',
            'product_category_id' => 4,
            'user_id' => User::all()->random()->id,
        ]);
        ProductType::factory(300)->create();
    }
}
