<?php

namespace Database\Seeders\IncomingInvoice;

use App\Models\IncomingInvoice\IncomingInvoice;
use App\Models\IncomingInvoice\IncomingInvoiceContent;
use App\Models\IncomingInvoice\IncomingInvoiceKit;
use App\Models\IncomingInvoice\ReturnedIncomingInvoice;
use App\Models\IncomingInvoice\ReturnedIncomingInvoiceKit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IncomingInvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        IncomingInvoice::truncate();
        IncomingInvoiceContent::truncate();
        IncomingInvoiceKit::truncate();
        ReturnedIncomingInvoice::truncate();
        ReturnedIncomingInvoiceKit::truncate();

        IncomingInvoice::factory(5000)->create()->each(function ($IncomingInvoice) {
            if (rand(0, 1)) {
                IncomingInvoiceContent::factory(rand(1, 10))->create([
                    'incoming_invoice_id' => $IncomingInvoice->id,
                    'user_id' => $IncomingInvoice->user_id,
                ])->each(function ($IncomingInvoiceContent) {
                    if (rand(1, 10) == 5) {
                        ReturnedIncomingInvoice::create([
                            'incoming_invoice_id' => $IncomingInvoiceContent->incoming_invoice_id,
                            'date' => Carbon::today()->subDays(rand(0, 10)),
                            'product_id' => $IncomingInvoiceContent->product_id,
                            'quantity' => rand(1, $IncomingInvoiceContent->quantity),
                            'user_id' => User::all()->random()->id,
                        ]);
                    }
                });
            } elseif (rand(0, 1)) {
                IncomingInvoiceContent::factory(rand(1, 10))->create([
                    'incoming_invoice_id' => $IncomingInvoice->id,
                    'user_id' => $IncomingInvoice->user_id,
                ])->each(function ($IncomingInvoiceContent) {
                    if (rand(1, 10) == 5) {
                        ReturnedIncomingInvoice::create([
                            'incoming_invoice_id' => $IncomingInvoiceContent->incoming_invoice_id,
                            'date' => Carbon::today()->subDays(rand(0, 10)),
                            'product_id' => $IncomingInvoiceContent->product_id,
                            'quantity' => rand(1, $IncomingInvoiceContent->quantity),
                            'user_id' => User::all()->random()->id,
                        ]);
                    }
                });

                IncomingInvoiceKit::factory(rand(1, 10))->create([
                    'incoming_invoice_id' => $IncomingInvoice->id,
                    'user_id' => $IncomingInvoice->user_id,
                ])->each(function ($IncomingInvoiceContent) {
                    if (rand(1, 10) == 5) {
                        ReturnedIncomingInvoiceKit::create([
                            'incoming_invoice_id' => $IncomingInvoiceContent->incoming_invoice_id,
                            'date' => Carbon::today()->subDays(rand(0, 10)),
                            'kit_id' => $IncomingInvoiceContent->kit_id,
                            'quantity' => rand(1, $IncomingInvoiceContent->quantity),
                            'user_id' => User::all()->random()->id,
                        ]);
                    }
                });
            } else {
                IncomingInvoiceKit::factory(rand(1, 10))->create([
                    'incoming_invoice_id' => $IncomingInvoice->id,
                    'user_id' => $IncomingInvoice->user_id,
                ])->each(function ($IncomingInvoiceContent) {
                    if (rand(1, 10) == 5) {
                        ReturnedIncomingInvoiceKit::create([
                            'incoming_invoice_id' => $IncomingInvoiceContent->incoming_invoice_id,
                            'date' => Carbon::today()->subDays(rand(0, 10)),
                            'kit_id' => $IncomingInvoiceContent->kit_id,
                            'quantity' => rand(1, $IncomingInvoiceContent->quantity),
                            'user_id' => User::all()->random()->id,
                        ]);
                    }
                });
            }
        });
    }
}
