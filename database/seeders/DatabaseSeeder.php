<?php

namespace Database\Seeders;

use Database\Seeders\Product\ProductBrandSeeder;
use Database\Seeders\Product\ProductCategorySeeder;
use Database\Seeders\Product\ProductCollectionSeeder;
use Database\Seeders\Product\ProductColorSeeder;
use Database\Seeders\Product\ProductCountrySeeder;
use Database\Seeders\Product\ProductMaterialSeeder;
use Database\Seeders\Product\ProductModelSeeder;
use Database\Seeders\Product\ProductSeeder;
use Database\Seeders\Product\ProductTypeSeeder;
use Database\Seeders\People\PeopleSeeder;
use Database\Seeders\Kit\KitSeeder;
use Database\Seeders\Warehouse\WarehouseSeeder;
use Database\Seeders\Warehouse\WarehouseStockSeeder;
use Database\Seeders\Cash\CashSeeder;
use Database\Seeders\Debtor\DebtorSeeder;
use Database\Seeders\IncomingInvoice\IncomingInvoiceSeeder;
use Database\Seeders\OutgoingInvoice\OutgoingInvoiceSeeder;
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
        // \App\Models\User::factory()->create([
        //     'id' => 1,
        //     'name' => 'Power',
        //     'email' => 'powerismynickname2016@gmail.com',
        //     'password' => '$2y$10$QCtPNdsiwvpQvC5rYkSG3uXHP8RJs2gtsVUlIqBbh1XT1ZiRchEfG',
        //     'profile_photo_path' => NULL,
        // ]);
        // \App\Models\User::factory(10)->create();
        // $this->call(ProductCategorySeeder::class);
        // $this->call(ProductTypeSeeder::class);
        // $this->call(ProductCountrySeeder::class);
        // $this->call(ProductBrandSeeder::class);
        // $this->call(ProductCollectionSeeder::class);
        // $this->call(ProductModelSeeder::class);
        // $this->call(ProductColorSeeder::class);
        // $this->call(ProductMaterialSeeder::class);
        // $this->call(ProductSeeder::class);
        // $this->call(PeopleSeeder::class);
        // $this->call(WarehouseSeeder::class);
        // $this->call(KitSeeder::class);
        // $this->call(WarehouseStockSeeder::class);
        // $this->call(CashSeeder::class);
        // $this->call(IncomingInvoiceSeeder::class);
        // $this->call(DebtorSeeder::class);
        $this->call(OutgoingInvoiceSeeder::class);
        // $this->call(ExpenseSeeder::class);
        // $this->call(OutgoingInvoiceSeeder::class);
        // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
