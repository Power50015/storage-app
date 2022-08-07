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
            'product_country_id' => 1,
            'user_id' => 1,
        ]);

        \App\Models\ProductBrand::factory()->create([
            'id' => 2,
            'name' => 'فلامنجو',
            'logo' => 'image/brand/qIEPDS8DOGl58ekl6AshCLmKu2Q1xWH5et41Qh3B.png',
            'product_country_id' => 1,
            'user_id' => 1,
        ]);

        \App\Models\ProductBrand::factory()->create([
            'id' => 3,
            'name' => 'قادوس',
            'logo' => 'image/brand/Xz8HBbCc5GrHInidqnZ4IqKRefAloynRdhktfbnG.png',
            'product_country_id' => 1,
            'user_id' => 1,
        ]);

        \App\Models\ProductBrand::factory()->create([
            'id' => 4,
            'name' => 'تيفال',
            'logo' => 'image/brand/o0FaO4YwUB9kslo3HlisxW3uwd8g0xUYOelXfn40.png',
            'product_country_id' => 6,
            'user_id' => 1,
        ]);

        \App\Models\ProductBrand::factory()->create([
            'id' => 5,
            'name' => 'بلو كورل',
            'logo' => 'image/brand/fYjYnqyNnFXC5sZNbPkdcG71lQVZCmrFDQcb34Oy.png',
            'product_country_id' => 4,
            'user_id' => 1,
        ]);

        \App\Models\ProductBrand::factory()->create([
            'id' => 6,
            'name' => 'سيفلون',
            'logo' => 'image/brand/SibeacJ1S52bTed2KA4MFtwXCQA1jItOMgS9WsrE.png',
            'product_country_id' => 6,
            'user_id' => 1,
        ]);
    }
}
