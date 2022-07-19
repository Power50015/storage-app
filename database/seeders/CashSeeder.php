<?php

namespace Database\Seeders;

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
        \App\Models\Cash::factory()->create([
            'title' => 'الخزنه',
            'attachment' => null,
            'user' => 1,
        ]);
        \App\Models\Cash::factory()->create([
            'title' => 'درج',
            'attachment' => null,
            'user' => 1,
        ]);
        \App\Models\Cash::factory()->create([
            'title' => 'حساب بنك  مصر رئيسى | 010000000000',
            'attachment' => null,
            'user' => 1,
        ]);
    }
}
