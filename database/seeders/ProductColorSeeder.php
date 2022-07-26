<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ProductColor::factory()->create([
            'name' => 'إيفورى',
            'user_id' => 1,
        ]);
        \App\Models\ProductColor::factory()->create([
            'name' => 'أبيض',
            'user_id' => 1,
        ]);
        \App\Models\ProductColor::factory()->create([
            'name' => 'أسود',
            'user_id' => 1,
        ]);
        \App\Models\ProductColor::factory()->create([
            'name' => 'أحمر',
            'user_id' => 1,
        ]);
        \App\Models\ProductColor::factory()->create([
            'name' => 'أحمر و أبيض',
            'user_id' => 1,
        ]);
        \App\Models\ProductColor::factory()->create([
            'name' => 'إيفورى و دهب',
            'user_id' => 1,
        ]);
        \App\Models\ProductColor::factory()->create([
            'name' => 'أبيض و دهب',
            'user_id' => 1,
        ]);
    }
}
