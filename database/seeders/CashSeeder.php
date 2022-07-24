<?php

namespace Database\Seeders;

use App\Models\Cash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CashSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cash::truncate();
        Cash::create([
            'title' => 'الخزنه',
            'attachment' => null,
            'user' => 1,
        ]);
        Cash::create([
            'title' => 'درج',
            'attachment' => null,
            'user' => 1,
        ]);
        Cash::create([
            'title' => 'حساب بنك  مصر رئيسى | 010000000000',
            'attachment' => null,
            'user' => 1,
        ]);
    }
}
