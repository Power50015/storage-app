<?php

namespace Database\Seeders\Creditor;

use App\Models\Creditor\Creditor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreditorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Creditor::truncate();
        Creditor::factory(80)->create();
    }
}
