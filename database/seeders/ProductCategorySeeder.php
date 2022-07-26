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
            'name' => 'أدوات سفرة',
            'user_id' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'name' => 'أدوات خبز',
            'user_id' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'name' => 'أدوات تقطيع',
            'user_id' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'name' => 'أدوات كهربائيه',
            'user_id' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'name' => 'أدوات طهى',
            'user_id' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'name' => 'مستلزمات شاى و قهوه',
            'user_id' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'name' => 'حوافظ و أدوات تنظيم المطبخ',
            'user_id' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'name' => 'أدوات تقديم',
            'user_id' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'name' => 'أدوات مائدة',
            'user_id' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'name' => 'مفروشات',
            'user_id' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'name' => 'رفايع و أدوات',
            'user_id' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'name' => 'أدوات شرب',
            'user_id' => 1,
        ]);
    }
}
