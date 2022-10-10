<?php

namespace Database\Seeders\IncomingInvoice;

use App\Models\IncomingInvoice\IncomingInvoice;
use App\Models\IncomingInvoice\IncomingInvoiceContent;
use App\Models\IncomingInvoice\IncomingInvoiceKit;
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

        IncomingInvoice::factory(5000)->create()->each(function ($IncomingInvoice) {
            if (rand(0, 1)) {
                IncomingInvoiceContent::factory(rand(1, 10))->create([
                    'incoming_invoice_id' => $IncomingInvoice->id,
                    'user_id' => $IncomingInvoice->user_id,
                ]);
            } elseif (rand(0, 1)) {
                IncomingInvoiceContent::factory(rand(1, 10))->create([
                    'incoming_invoice_id' => $IncomingInvoice->id,
                    'user_id' => $IncomingInvoice->user_id,
                ]);

                IncomingInvoiceKit::factory(rand(1, 10))->create([
                    'incoming_invoice_id' => $IncomingInvoice->id,
                    'user_id' => $IncomingInvoice->user_id,
                ]);
            } else {
                IncomingInvoiceKit::factory(rand(1, 10))->create([
                    'incoming_invoice_id' => $IncomingInvoice->id,
                    'user_id' => $IncomingInvoice->user_id,
                ]);
            }
        });

    }
    
}
