<?php

namespace Database\Seeders\Driver;

use App\Models\Driver\Driver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Driver::truncate();
        Driver::factory(1000)->create();
    }
}
