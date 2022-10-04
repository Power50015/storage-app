<?php

namespace Database\Seeders\Warehouse;

use App\Models\User;
use App\Models\Warehouse\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Warehouse::truncate();
        Warehouse::create([
            'name' => 'المخزن الكبير',
            'address' => 'السيدة زينب',
            'user_id' => User::all()->random()->id,
        ]);
        Warehouse::create([
            'name' => 'المخزن رئيسى',
            'address' => 'درب السعادة',
            'user_id' => User::all()->random()->id,
        ]);
        Warehouse::create([
            'name' => 'مخزن ترنزيت 1',
            'address' => 'الزاويه',
            'user_id' => User::all()->random()->id,
        ]);
        Warehouse::create([
            'name' => 'مخزن ترنزيت 2',
            'address' => 'الزاويه',
            'user_id' => User::all()->random()->id,
        ]);
        Warehouse::factory(15)->create();
        Warehouse::factory(15)->create();
        Warehouse::factory(50)->create();
    }
}
