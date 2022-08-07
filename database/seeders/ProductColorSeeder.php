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
            'id' => 1,
            'name' => 'إيفورى',
            'user_id' => 1,
        ]);
        \App\Models\ProductColor::factory()->create([
            'id' => 2,
            'name' => 'أبيض',
            'user_id' => 1,
        ]);
        \App\Models\ProductColor::factory()->create([
            'id' => 3,
            'name' => 'أسود',
            'user_id' => 1,
        ]);
        \App\Models\ProductColor::factory()->create([
            'id' => 4,
            'name' => 'أحمر',
            'user_id' => 1,
        ]);
        \App\Models\ProductColor::factory()->create([
            'id' => 5,
            'name' => 'أحمر و أبيض',
            'user_id' => 1,
        ]);
        \App\Models\ProductColor::factory()->create([
            'id' => 6,
            'name' => 'إيفورى و دهب',
            'user_id' => 1,
        ]);
        \App\Models\ProductColor::factory()->create([
            'id' => 7,
            'name' => 'أبيض و دهب',
            'user_id' => 1,
        ]);
    }
}
