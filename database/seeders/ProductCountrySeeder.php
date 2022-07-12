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
            'name' => 'مصر',
            'user' => 1,
        ]);
        \App\Models\ProductCountry::factory()->create([
            'name' => 'الصين',
            'user' => 1,
        ]);
        \App\Models\ProductCountry::factory()->create([
            'name' => 'السعوديه',
            'user' => 1,
        ]);
        \App\Models\ProductCountry::factory()->create([
            'name' => 'أمريكا',
            'user' => 1,
        ]);
        \App\Models\ProductCountry::factory()->create([
            'name' => 'اليابان',
            'user' => 1,
        ]);
    }
}
