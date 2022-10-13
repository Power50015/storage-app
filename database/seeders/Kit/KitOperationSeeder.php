<?php

namespace Database\Seeders\Kit;

use App\Models\Kit\KitOperation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KitOperationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KitOperation::truncate();
        KitOperation::factory(10)->create();
    }
}
