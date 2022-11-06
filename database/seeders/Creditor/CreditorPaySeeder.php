<?php

namespace Database\Seeders\Creditor;

use App\Models\Creditor\CreditorPay;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreditorPaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CreditorPay::truncate();
        CreditorPay::factory(10000)->create();
    }
}
