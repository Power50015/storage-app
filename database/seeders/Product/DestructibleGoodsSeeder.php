<?php

namespace Database\Seeders\Product;

use App\Models\Product\DestructibleGoods;
use App\Models\Product\DestructibleGoodsAction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;

class DestructibleGoodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DestructibleGoods::truncate();
        DestructibleGoodsAction::truncate();
        DestructibleGoods::factory(10)->create()->each(function ($product) {
            $faker = FakerFactory::create('ar_SA');
            DestructibleGoodsAction::factory(1)->create([
                'title' => $faker->unique()->word(),
                'description' => $faker->unique()->text(),
                'action' => 0,
                'date' => $faker->dateTimeBetween('-10 days', now()),
                'destructible_goods_id' => $product->id,
                'user_id' => $product->user_id,
            ])->each(function ($action) {
                if (rand(0, 1)) {
                    $faker = FakerFactory::create('ar_SA');
                    DestructibleGoodsAction::factory(1)->create([
                        'title' => $faker->unique()->word(),
                        'description' => $faker->unique()->text(),
                        'action' => $faker->randomElement([1, 2]),
                        'date' => $faker->dateTimeBetween('-10 days', now()),
                        'destructible_goods_id' => $action->destructible_goods_id,
                        'user_id' => $action->user_id,
                    ]);
                }
            });;
        });;
    }
}
