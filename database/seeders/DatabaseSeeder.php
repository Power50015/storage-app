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
        
        // $this->call(ProductBrandSeeder::class);
        // $this->call(ProductCategorySeeder::class);
        // $this->call(ProductCollectionSeeder::class);
        // $this->call(ProductColorSeeder::class);
        // $this->call(ProductCountrySeeder::class);
        // $this->call(ProductMaterialSeeder::class);
        // $this->call(ProductModelSeeder::class);
        // $this->call(ProductTypeSeeder::class);
        // $this->call(ProductSeeder::class);
        // $this->call(WarehouseSeeder::class);
        // $this->call(ExpenseSeeder::class);
        // $this->call(PeopleSeeder::class);
        // $this->call(CashSeeder::class);
        
        $this->call(IncomingInvoiceSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
