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
            'user' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'name' => 'أدوات خبز',
            'user' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'name' => 'أدوات تقطيع',
            'user' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'name' => 'أدوات كهربائيه',
            'user' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'name' => 'أدوات طهى',
            'user' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'name' => 'مستلزمات شاى و قهوه',
            'user' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'name' => 'حوافظ و أدوات تنظيم المطبخ',
            'user' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'name' => 'أدوات تقديم',
            'user' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'name' => 'أدوات مائدة',
            'user' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'name' => 'مفروشات',
            'user' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'name' => 'رفايع و أدوات',
            'user' => 1,
        ]);
        \App\Models\ProductCategory::factory()->create([
            'name' => 'أدوات شرب',
            'user' => 1,
        ]);
    }
}
