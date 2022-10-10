<?php

namespace Database\Seeders\Cash;

use App\Models\Cash\Cash;
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
            'user_id' => 1,
        ]);
        Cash::create([
            'title' => 'درج',
            'attachment' => null,
            'user_id' => 1,
        ]);
        Cash::create([
            'title' => 'حساب بنك  مصر رئيسى | 010000000000',
            'attachment' => null,
            'user_id' => 1,
        ]);
        Cash::create([
            'title' => 'حساب CIB  مصر رئيسى | 010043200432400',
            'attachment' => null,
            'user_id' => 1,
        ]);
        Cash::factory(10)->create();
    }
}
