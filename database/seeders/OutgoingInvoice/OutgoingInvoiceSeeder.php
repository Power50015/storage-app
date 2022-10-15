<?php

namespace Database\Seeders\OutgoingInvoice;

use App\Models\OutgoingInvoice\OutgoingInvoice;
use App\Models\OutgoingInvoice\OutgoingInvoiceContent;
use App\Models\OutgoingInvoice\OutgoingInvoiceKit;
use App\Models\OutgoingInvoice\ReturnedOutgoingInvoice;
use App\Models\OutgoingInvoice\ReturnedOutgoingInvoiceKit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OutgoingInvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OutgoingInvoice::truncate();
        OutgoingInvoiceContent::truncate();
        OutgoingInvoiceKit::truncate();
        ReturnedOutgoingInvoice::truncate();
        ReturnedOutgoingInvoiceKit::truncate();

        OutgoingInvoice::factory(2000)->create()->each(function ($OutgoingInvoice) {
            if (rand(0, 1)) {
                OutgoingInvoiceContent::factory(rand(1, 10))->create([
                    'outgoing_invoice_id' => $OutgoingInvoice->id,
                    'user_id' => $OutgoingInvoice->user_id,
                ])->each(function ($OutgoingInvoiceKit) {
                    if (rand(1, 10) == 5) {
                        ReturnedOutgoingInvoice::create([
                            'outgoing_invoice_id' => $OutgoingInvoiceKit->outgoing_invoice_id,
                            'date' => Carbon::today()->subDays(rand(0, 10)),
                            'product_id' => $OutgoingInvoiceKit->product_id,
                            'quantity' => rand(1, $OutgoingInvoiceKit->quantity),
                            'user_id' => User::all()->random()->id,
                        ]);
                    }
                });
            } elseif (rand(0, 1)) {
                OutgoingInvoiceContent::factory(rand(1, 10))->create([
                    'outgoing_invoice_id' => $OutgoingInvoice->id,
                    'user_id' => $OutgoingInvoice->user_id,
                ])->each(function ($OutgoingInvoiceKit) {
                    if (rand(1, 10) == 5) {
                        ReturnedOutgoingInvoice::create([
                            'outgoing_invoice_id' => $OutgoingInvoiceKit->outgoing_invoice_id,
                            'date' => Carbon::today()->subDays(rand(0, 10)),
                            'product_id' => $OutgoingInvoiceKit->product_id,
                            'quantity' => rand(1, $OutgoingInvoiceKit->quantity),
                            'user_id' => User::all()->random()->id,
                        ]);
                    }
                });

                OutgoingInvoiceKit::factory(rand(1, 10))->create([
                    'outgoing_invoice_id' => $OutgoingInvoice->id,
                    'user_id' => $OutgoingInvoice->user_id,
                ])->each(function ($OutgoingInvoiceKit) {
                    if (rand(1, 10) == 5) {
                        ReturnedOutgoingInvoiceKit::create([
                            'outgoing_invoice_id' => $OutgoingInvoiceKit->outgoing_invoice_id,
                            'date' => Carbon::today()->subDays(rand(0, 10)),
                            'kit_id' => $OutgoingInvoiceKit->kit_id,
                            'quantity' => rand(1, $OutgoingInvoiceKit->quantity),
                            'user_id' => User::all()->random()->id,
                        ]);
                    }
                });
            } else {
                OutgoingInvoiceKit::factory(rand(1, 10))->create([
                    'outgoing_invoice_id' => $OutgoingInvoice->id,
                    'user_id' => $OutgoingInvoice->user_id,
                ])->each(function ($OutgoingInvoiceKit) {
                    if (rand(1, 10) == 5) {
                        ReturnedOutgoingInvoiceKit::create([
                            'outgoing_invoice_id' => $OutgoingInvoiceKit->outgoing_invoice_id,
                            'date' => Carbon::today()->subDays(rand(0, 10)),
                            'kit_id' => $OutgoingInvoiceKit->kit_id,
                            'quantity' => rand(1, $OutgoingInvoiceKit->quantity),
                            'user_id' => User::all()->random()->id,
                        ]);
                    }
                });
            }
        });
    }
}
