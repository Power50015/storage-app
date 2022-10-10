<?php

namespace Database\Seeders\Debtor;

use App\Models\Debtor\Debtor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DebtorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Debtor::truncate();
        Debtor::factory(80)->create();
    }
}
