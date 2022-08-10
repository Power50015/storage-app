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
        \App\Models\User::factory()->create([
            'id' => 1,
            'name' => 'User',
            'email' => 'powerismynickname2016@gmail.com',
            'password' => '$2y$10$QCtPNdsiwvpQvC5rYkSG3uXHP8RJs2gtsVUlIqBbh1XT1ZiRchEfG',
            'profile_photo_path' => 'profile-photos/74HRN1ifvWtpIC3sPJJD7swV8JtPN4HgBSoRNHgf.jpg',
        ]);

        $this->call(ProductCategorySeeder::class);
        $this->call(ProductTypeSeeder::class);
        $this->call(ProductCountrySeeder::class);
        // $this->call(ProductBrandSeeder::class);
        $this->call(ProductColorSeeder::class);
        $this->call(ProductMaterialSeeder::class);
        // $this->call(ProductCollectionSeeder::class);

        // $this->call(ProductModelSeeder::class);
        // $this->call(ProductSeeder::class);
        // $this->call(WarehouseSeeder::class);
        // $this->call(ExpenseSeeder::class);
        // $this->call(PeopleSeeder::class);
        // $this->call(CashSeeder::class);
        // $this->call(IncomingInvoiceSeeder::class);
        // $this->call(IncomingInvoiceContentSeeder::class);
        // $this->call(IncomingInvoiceAttachmentSeeder::class);
        // $this->call(OutgoingInvoiceSeeder::class);
        // $this->call(OutgoingInvoiceContentSeeder::class);
        // $this->call(OutgoingInvoiceAttachmentSeeder::class);
        // $this->call(WarehouseStockSeeder::class);
        // $this->call(WarehouseStockContentSeeder::class);
        // $this->call(WarehouseStockAttachmentSeeder::class);

        // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
