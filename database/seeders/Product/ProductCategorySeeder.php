<?php

namespace Database\Seeders\Product;

use App\Models\Product\ProductCategory;
use App\Models\User;
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
        ProductCategory::truncate();
        ProductCategory::factory()->create([
            'name' => 'أدوات سفرة',
            'user_id' => User::all()->random()->id,
        ]);
        ProductCategory::factory()->create([
            'name' => 'أدوات خبز',
            'user_id' => User::all()->random()->id,
        ]);
        ProductCategory::factory()->create([
            'name' => 'أدوات تقطيع',
            'user_id' => User::all()->random()->id,
        ]);
        ProductCategory::factory()->create([
            'name' => 'أدوات كهربائيه',
            'user_id' => User::all()->random()->id,
        ]);
        ProductCategory::factory()->create([
            'name' => 'أدوات طهى',
            'user_id' => User::all()->random()->id,
        ]);
        ProductCategory::factory()->create([
            'name' => 'مستلزمات شاى و قهوه',
            'user_id' => User::all()->random()->id,
        ]);
        ProductCategory::factory()->create([
            'name' => 'حوافظ و أدوات تنظيم المطبخ',
            'user_id' => User::all()->random()->id,
        ]);
        ProductCategory::factory()->create([
            'name' => 'أدوات تقديم',
            'user_id' => User::all()->random()->id,
        ]);
        ProductCategory::factory()->create([
            'name' => 'أدوات مائدة',
            'user_id' => User::all()->random()->id,
        ]);
        ProductCategory::factory()->create([
            'name' => 'مفروشات',
            'user_id' => User::all()->random()->id,
        ]);
        ProductCategory::factory()->create([
            'name' => 'رفايع و أدوات',
            'user_id' => User::all()->random()->id,
        ]);
        ProductCategory::factory()->create([
            'name' => 'أدوات شرب',
            'user_id' => User::all()->random()->id,
        ]);
        ProductCategory::factory(5)->create();
    }
}
