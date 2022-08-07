<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ProductCountry::factory()->create([
            'id' => 1,
            'name' => 'مصر',
            'user_id' => 1,
        ]);
        \App\Models\ProductCountry::factory()->create([
            'id' => 2,
            'name' => 'الصين',
            'user_id' => 1,
        ]);
        \App\Models\ProductCountry::factory()->create([
            'id' => 3,
            'name' => 'السعوديه',
            'user_id' => 1,
        ]);
        \App\Models\ProductCountry::factory()->create([
            'id' => 4,
            'name' => 'أمريكا',
            'user_id' => 1,
        ]);
        \App\Models\ProductCountry::factory()->create([
            'id' => 5,
            'name' => 'اليابان',
            'user_id' => 1,
        ]);
        \App\Models\ProductCountry::factory()->create([
            'id' => 6,
            'name' => 'تركيا',
            'user_id' => 1,
        ]);
    }
}
