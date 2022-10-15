<?php

namespace Database\Seeders\Kit;

use App\Models\Kit\Kit;
use App\Models\Kit\KitAttachment;
use App\Models\Kit\KitImage;
use App\Models\Kit\KitNote;
use App\Models\Product\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class KitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kit::truncate();
        KitNote::truncate();
        KitNote::truncate();
        Storage::deleteDirectory('public/image/kit');
        Storage::deleteDirectory('public/attachment/kit');
        
        Kit::factory()->create([
            'title' => "طبق مدور",
            'description' => "",
            'image' => function () {
                $url = "https://eg.jumia.is/unsafe/fit-in/680x680/filters:fill(white)/product/23/264172/4.jpg";
                $contents = file_get_contents($url);
                $name = substr($url, strrpos($url, '/') + 1);
                Storage::put('public/image/kit/' . $name, $contents);
                return 'image/kit/' . $name;
            },
            'user_id' => User::all()->random()->id,
            'product_id' => Product::all()->random()->id,
        ])->each(function ($kit) {
            if (rand(0, 1)) {
                KitNote::factory(rand(1, 10))->create([
                    'kit_id' => $kit->id
                ]);
            }
            if (rand(0, 1)) {
                KitAttachment::factory(rand(1, 10))->create([
                    'kit_id' => $kit->id
                ]);
            }
            if (rand(0, 1)) {
                KitImage::factory(rand(1, 10))->create([
                    'kit_id' => $kit->id
                ]);
            }
        });
        Kit::factory()->create([
            'title' => "فنجان",
            'description' => "",
            'image' => function () {
                $url = "https://villeroyboch-egypt.com/wp-content/uploads/1035041420neu.jpg";
                $contents = file_get_contents($url);
                $name = substr($url, strrpos($url, '/') + 1);
                Storage::put('public/image/kit/' . $name, $contents);
                return 'image/kit/' . $name;
            },
            'user_id' => User::all()->random()->id,
            'product_id' => Product::all()->random()->id,
        ])->each(function ($kit) {
            if (rand(0, 1)) {
                KitNote::factory(rand(1, 10))->create([
                    'kit_id' => $kit->id
                ]);
            }
            if (rand(0, 1)) {
                KitAttachment::factory(rand(1, 10))->create([
                    'kit_id' => $kit->id
                ]);
            }
            if (rand(0, 1)) {
                KitImage::factory(rand(1, 10))->create([
                    'kit_id' => $kit->id
                ]);
            }
        });
        Kit::factory(10)->create()->each(function ($kit) {
            if (rand(0, 1)) {
                KitNote::factory(rand(1, 10))->create([
                    'kit_id' => $kit->id
                ]);
            }
            if (rand(0, 1)) {
                KitAttachment::factory(rand(1, 10))->create([
                    'kit_id' => $kit->id
                ]);
            }
            if (rand(0, 1)) {
                KitImage::factory(rand(1, 10))->create([
                    'kit_id' => $kit->id
                ]);
            }
        });
        Kit::factory(10)->create()->each(function ($kit) {
            if (rand(0, 1)) {
                KitNote::factory(rand(1, 10))->create([
                    'kit_id' => $kit->id
                ]);
            }
            if (rand(0, 1)) {
                KitAttachment::factory(rand(1, 10))->create([
                    'kit_id' => $kit->id
                ]);
            }
            if (rand(0, 1)) {
                KitImage::factory(rand(1, 10))->create([
                    'kit_id' => $kit->id
                ]);
            }
        });
        Kit::factory(10)->create()->each(function ($kit) {
            if (rand(0, 1)) {
                KitNote::factory(rand(1, 10))->create([
                    'kit_id' => $kit->id
                ]);
            }
            if (rand(0, 1)) {
                KitAttachment::factory(rand(1, 10))->create([
                    'kit_id' => $kit->id
                ]);
            }
            if (rand(0, 1)) {
                KitImage::factory(rand(1, 10))->create([
                    'kit_id' => $kit->id
                ]);
            }
        });
    }
}
