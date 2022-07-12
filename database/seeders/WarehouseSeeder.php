<?php

namespace Database\Seeders;

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
        \App\Models\Warehouse::factory()->create([
            'name' => 'المخزن الكبير',
            'address' => 'السيدة زينب',
            'user' => 1,
        ]);
        \App\Models\Warehouse::factory()->create([
            'name' => 'المخزن رئيسى',
            'address' => 'درب السعادة',
            'user' => 1,
        ]);
        \App\Models\Warehouse::factory()->create([
            'name' => 'مخزن ترنزيت 1',
            'address' => 'الزاويه',
            'user' => 1,
        ]);
        \App\Models\Warehouse::factory()->create([
            'name' => 'مخزن ترنزيت 2',
            'address' => 'الزاويه',
            'user' => 1,
        ]);
    }
}
