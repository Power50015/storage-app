<?php

namespace Database\Seeders\Warehouse;

use App\Models\Warehouse\KitStock;
use App\Models\User;
use App\Models\Warehouse\WarehouseStock;
use App\Models\Warehouse\WarehouseStockContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WarehouseStock::truncate();
        WarehouseStockContent::truncate();
        WarehouseStock::create([
            'title' => 'أول المخزون',
            'user_id' => User::all()->random()->id,
            'warehouse_id' => 1,
        ])->each(function ($WarehouseStock) {

            WarehouseStockContent::factory(rand(1, 10))->create([
                'warehouse_stock_id' => $WarehouseStock->id,
                'user_id' => $WarehouseStock->user_id,
            ]);

            KitStock::factory(rand(1, 10))->create([
                'warehouse_stock_id' => $WarehouseStock->id,
                'user_id' => $WarehouseStock->user_id,
            ]);
        });

        WarehouseStock::factory(5000)->create()->each(function ($WarehouseStock) {
            if (rand(0, 1)) {
                WarehouseStockContent::factory(rand(1, 10))->create([
                    'warehouse_stock_id' => $WarehouseStock->id,
                    'user_id' => $WarehouseStock->user_id,
                ]);
            } elseif (rand(0, 1)) {
                WarehouseStockContent::factory(rand(1, 10))->create([
                    'warehouse_stock_id' => $WarehouseStock->id,
                    'user_id' => $WarehouseStock->user_id,
                ]);

                KitStock::factory(rand(1, 10))->create([
                    'warehouse_stock_id' => $WarehouseStock->id,
                    'user_id' => $WarehouseStock->user_id,
                ]);
            } else {
                KitStock::factory(rand(1, 10))->create([
                    'warehouse_stock_id' => $WarehouseStock->id,
                    'user_id' => $WarehouseStock->user_id,
                ]);
            }
        });
    }
}
