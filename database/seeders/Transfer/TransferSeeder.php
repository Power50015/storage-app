<?php

namespace Database\Seeders\Transfer;

use App\Models\Transfer\Transfer;
use App\Models\Transfer\TransferContent;
use App\Models\Transfer\TransferKit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transfer::truncate();
        TransferContent::truncate();
        TransferKit::truncate();

        Transfer::factory(200)->create()->each(function ($transfer) {
            if (rand(0, 1)) {
                TransferContent::factory(rand(1, 10))->create([
                    'transfer_id' => $transfer->id,
                    'user_id' => $transfer->user_id,
                ]);
            } elseif (rand(0, 1)) {
                TransferContent::factory(rand(1, 10))->create([
                    'transfer_id' => $transfer->id,
                    'user_id' => $transfer->user_id,
                ]);

                TransferKit::factory(rand(1, 10))->create([
                    'transfer_id' => $transfer->id,
                    'user_id' => $transfer->user_id,
                ]);
            } else {
                TransferKit::factory(rand(1, 10))->create([
                    'transfer_id' => $transfer->id,
                    'user_id' => $transfer->user_id,
                ]);
            }
        });
    }
}
