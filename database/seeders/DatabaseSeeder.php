<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProductBrandSeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(ProductColorSeeder::class);
        $this->call(ProductCountrySeeder::class);
        $this->call(ProductMaterialSeeder::class);
        $this->call(ProductTypeSeeder::class);
        $this->call(WarehouseSeeder::class);
        $this->call(ProductSeeder::class);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
