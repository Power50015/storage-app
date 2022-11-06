<?php

namespace Database\Seeders\Debtor;

use App\Models\Debtor\DebtorPay;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DebtorPaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DebtorPay::truncate();
        DebtorPay::factory(10000)->create();
    }
}
