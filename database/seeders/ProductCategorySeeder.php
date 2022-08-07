<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ProductCategory::factory()->create([
            'id' => 1,
            'name' => 'أدوات سفرة',
            'user_id' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'id' => 2,
            'name' => 'أدوات خبز',
            'user_id' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'id' => 3,
            'name' => 'أدوات تقطيع',
            'user_id' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'id' => 4,
            'name' => 'أدوات كهربائيه',
            'user_id' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'id' => 5,
            'name' => 'أدوات طهى',
            'user_id' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'id' => 6,
            'name' => 'مستلزمات شاى و قهوه',
            'user_id' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'id' => 7,
            'name' => 'حوافظ و أدوات تنظيم المطبخ',
            'user_id' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'id' => 8,
            'name' => 'أدوات تقديم',
            'user_id' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'id' => 9,
            'name' => 'أدوات مائدة',
            'user_id' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'id' => 10,
            'name' => 'مفروشات',
            'user_id' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'id' => 11,
            'name' => 'رفايع و أدوات',
            'user_id' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'id' => 12,
            'name' => 'أدوات شرب',
            'user_id' => 1,
        ]);
    }
}
