<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\People::factory()->create([
            'name' => 'الشركة المصرية الألمانية لصناعة البورسلين',
            'phone' => '01227436431',
            'logo' => 'image/people/264101_106613776100721_50785_n.jpg',
            'address' => 'مصر إسكندريه الصحراوى',
            'type' => 'مورد',
            'user_id' => 1,
        ]);
        \App\Models\People::factory()->create([
            'name' => 'عبد الوهاب',
            'phone' => '01115436431',
            'logo' => null,
            'address' => 'المقطم',
            'type' => 'عميل',
            'user_id' => 1,
        ]);
    }
}
