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
                    'people_id' => $OutgoingInvoice->people_id,
                ])->each(function ($OutgoingInvoiceKit) {
                    if (rand(1, 10) == 5) {
                        $ReturnedOutgoingInvoice = ReturnedOutgoingInvoice::create([
                            'outgoing_invoice_id' => $OutgoingInvoiceKit->outgoing_invoice_id,
                            'date' => Carbon::today()->subDays(rand(0, 10)),
                            'product_id' => $OutgoingInvoiceKit->product_id,
                            'quantity' => rand(1, $OutgoingInvoiceKit->quantity),
                            'user_id' => User::all()->random()->id,
                            'people_id' => $OutgoingInvoiceKit->people_id,
                        ]);
                        $OutgoingInvoice =  OutgoingInvoice::find($ReturnedOutgoingInvoice->outgoing_invoice_id);
                        $OutgoingInvoice->total += ($OutgoingInvoiceKit->quantity - $ReturnedOutgoingInvoice->quantity) * $OutgoingInvoiceKit->price;
                        $OutgoingInvoice->save();
                    }
                    else {
                        $OutgoingInvoice =  OutgoingInvoice::find($OutgoingInvoiceKit->outgoing_invoice_id);
                        $OutgoingInvoice->total += $OutgoingInvoiceKit->quantity * $OutgoingInvoiceKit->price;
                        $OutgoingInvoice->save();
                    }
                });
            } elseif (rand(0, 1)) {
                OutgoingInvoiceContent::factory(rand(1, 10))->create([
                    'outgoing_invoice_id' => $OutgoingInvoice->id,
                    'user_id' => $OutgoingInvoice->user_id,
                    'people_id' => $OutgoingInvoice->people_id,
                ])->each(function ($OutgoingInvoiceKit) {
                    if (rand(1, 10) == 5) {
                        $ReturnedOutgoingInvoice = ReturnedOutgoingInvoice::create([
                            'outgoing_invoice_id' => $OutgoingInvoiceKit->outgoing_invoice_id,
                            'date' => Carbon::today()->subDays(rand(0, 10)),
                            'product_id' => $OutgoingInvoiceKit->product_id,
                            'quantity' => rand(1, $OutgoingInvoiceKit->quantity),
                            'user_id' => User::all()->random()->id,
                            'people_id' => $OutgoingInvoiceKit->people_id,
                        ]);
                        $OutgoingInvoice =  OutgoingInvoice::find($ReturnedOutgoingInvoice->outgoing_invoice_id);
                        $OutgoingInvoice->total += ($OutgoingInvoiceKit->quantity - $ReturnedOutgoingInvoice->quantity) * $OutgoingInvoiceKit->price;
                        $OutgoingInvoice->save();
                    }else {
                        $OutgoingInvoice =  OutgoingInvoice::find($OutgoingInvoiceKit->outgoing_invoice_id);
                        $OutgoingInvoice->total += $OutgoingInvoiceKit->quantity * $OutgoingInvoiceKit->price;
                        $OutgoingInvoice->save();
                    }
                });

                OutgoingInvoiceKit::factory(rand(1, 10))->create([
                    'outgoing_invoice_id' => $OutgoingInvoice->id,
                    'user_id' => $OutgoingInvoice->user_id,
                    'people_id' => $OutgoingInvoice->people_id,
                ])->each(function ($OutgoingInvoiceKit) {
                    if (rand(1, 10) == 5) {
                        $ReturnedOutgoingInvoice = ReturnedOutgoingInvoiceKit::create([
                            'outgoing_invoice_id' => $OutgoingInvoiceKit->outgoing_invoice_id,
                            'date' => Carbon::today()->subDays(rand(0, 10)),
                            'kit_id' => $OutgoingInvoiceKit->kit_id,
                            'quantity' => rand(1, $OutgoingInvoiceKit->quantity),
                            'user_id' => User::all()->random()->id,
                            'people_id' => $OutgoingInvoiceKit->people_id,
                        ]);
                        $OutgoingInvoice =  OutgoingInvoice::find($ReturnedOutgoingInvoice->outgoing_invoice_id);
                        $OutgoingInvoice->total += ($OutgoingInvoiceKit->quantity - $ReturnedOutgoingInvoice->quantity) * $OutgoingInvoiceKit->price;
                        $OutgoingInvoice->save();
                    }else {
                        $OutgoingInvoice =  OutgoingInvoice::find($OutgoingInvoiceKit->outgoing_invoice_id);
                        $OutgoingInvoice->total += $OutgoingInvoiceKit->quantity * $OutgoingInvoiceKit->price;
                        $OutgoingInvoice->save();
                    }
                });
            } else {
                OutgoingInvoiceKit::factory(rand(1, 10))->create([
                    'outgoing_invoice_id' => $OutgoingInvoice->id,
                    'user_id' => $OutgoingInvoice->user_id,
                    'people_id' => $OutgoingInvoice->people_id,
                ])->each(function ($OutgoingInvoiceKit) {
                    if (rand(1, 10) == 5) {
                        $ReturnedOutgoingInvoice =ReturnedOutgoingInvoiceKit::create([
                            'outgoing_invoice_id' => $OutgoingInvoiceKit->outgoing_invoice_id,
                            'date' => Carbon::today()->subDays(rand(0, 10)),
                            'kit_id' => $OutgoingInvoiceKit->kit_id,
                            'quantity' => rand(1, $OutgoingInvoiceKit->quantity),
                            'user_id' => User::all()->random()->id,
                            'people_id' => $OutgoingInvoiceKit->people_id,
                        ]);
                        $OutgoingInvoice =  OutgoingInvoice::find($ReturnedOutgoingInvoice->outgoing_invoice_id);
                        $OutgoingInvoice->total += ($OutgoingInvoiceKit->quantity - $ReturnedOutgoingInvoice->quantity) * $OutgoingInvoiceKit->price;
                        $OutgoingInvoice->save();
                    }
                    else {
                        $OutgoingInvoice =  OutgoingInvoice::find($OutgoingInvoiceKit->outgoing_invoice_id);
                        $OutgoingInvoice->total += $OutgoingInvoiceKit->quantity * $OutgoingInvoiceKit->price;
                        $OutgoingInvoice->save();
                    }
                });
            }
        });
    }
}
