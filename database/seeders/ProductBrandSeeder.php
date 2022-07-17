<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ProductBrand::factory()->create([
            'id' => 1,
            'name' => 'فتحى محمود',
            'logo' => 'image/brand/gHO0Hbkf0V0mo43YTO0Gg5p7cHL9Vnz0ZO6ke7Hc.png',
            'country' => 1,
            'user' => 1,
        ]);
    }
}
