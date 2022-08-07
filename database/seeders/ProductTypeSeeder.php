<?php

namespace Database\Seeders;

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
        \App\Models\ProductType::factory()->create([
            'id' => 1,
            'name' => 'أطقم صينى سفره',
            'product_category_id' => 1,
            'user_id' => 1,
        ]);
        \App\Models\ProductType::factory()->create([
            'id' => 2,
            'name' => 'أطقم شاى',
            'product_category_id' => 1,
            'user_id' => 1,
        ]);
        \App\Models\ProductType::factory()->create([
            'id' => 3,
            'name' => 'أطقم عشاء',
            'product_category_id' => 1,
            'user_id' => 1,
        ]);
        \App\Models\ProductType::factory()->create([
            'id' => 4,
            'name' => 'أطقم أيس كريم',
            'product_category_id' => 1,
            'user_id' => 1,
        ]);
        \App\Models\ProductType::factory()->create([
            'id' => 5,
            'name' => 'أطقم بولات',
            'product_category_id' => 1,
            'user_id' => 1,
        ]);
        \App\Models\ProductType::factory()->create([
            'id' => 6,
            'name' => 'طقم سلطانيه بالبولات',
            'product_category_id' => 1,
            'user_id' => 1,
        ]);
        \App\Models\ProductType::factory()->create([
            'id' => 7,
            'name' => 'صنيه كاب كيك',
            'product_category_id' => 2,
            'user_id' => 1,
        ]);
        \App\Models\ProductType::factory()->create([
            'id' => 8,
            'name' => 'صنيه خبز',
            'product_category_id' => 2,
            'user_id' => 1,
        ]);
        \App\Models\ProductType::factory()->create([
            'id' => 9,
            'name' => 'تزين كيكه',
            'product_category_id' => 2,
            'user_id' => 1,
        ]);
        \App\Models\ProductType::factory()->create([
            'id' => 10,
            'name' => 'طقم سكاكين',
            'product_category_id' => 3,
            'user_id' => 1,
        ]);
        \App\Models\ProductType::factory()->create([
            'id' => 11,
            'name' => 'سكينه شيف',
            'product_category_id' => 3,
            'user_id' => 1,
        ]);
        \App\Models\ProductType::factory()->create([
            'id' => 12,
            'name' => 'سكين خبز',
            'product_category_id' => 3,
            'user_id' => 1,
        ]);
        \App\Models\ProductType::factory()->create([
            'id' => 13,
            'name' => 'مسن سكاكين',
            'product_category_id' => 4,
            'user_id' => 1,
        ]);
        \App\Models\ProductType::factory()->create([
            'id' => 14,
            'name' => 'خلاط',
            'product_category_id' => 4,
            'user_id' => 1,
        ]);
        \App\Models\ProductType::factory()->create([
            'id' => 15,
            'name' => 'عجان',
            'product_category_id' => 4,
            'user_id' => 1,
        ]);
        \App\Models\ProductType::factory()->create([
            'id' => 16,
            'name' => 'مضرب',
            'product_category_id' => 4,
            'user_id' => 1,
        ]);
    }
}
