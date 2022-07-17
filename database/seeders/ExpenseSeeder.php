<?php

namespace Database\Seeders;

use App\Models\Expense;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Expense::factory()->create([
            'title' => 'كهرباء',
            'amount' => 85.5,
            'description' => 'كهرباء',
            'date' => '2022-07-14',
            'user' => 1,
        ]);
        \App\Models\Expense::factory()->create([
            'title' => 'مصاريف منشاوى',
            'amount' => 5,
            'description' => 'مشاوى راح المخزن',
            'date' => '2022-07-15',
            'user' => 1,
        ]);
    }
}
