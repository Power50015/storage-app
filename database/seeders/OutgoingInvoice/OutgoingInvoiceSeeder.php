<?php

namespace Database\Seeders\OutgoingInvoice;

use App\Models\OutgoingInvoice\OutgoingInvoice;
use App\Models\OutgoingInvoice\OutgoingInvoiceContent;
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

        OutgoingInvoice::factory(2000)->create()->each(function ($OutgoingInvoice) {
            OutgoingInvoiceContent::factory(rand(1, 10))->create([
                'outgoing_invoice_id' => $OutgoingInvoice->id,
                'user_id' => $OutgoingInvoice->user_id,
            ]);
        });
    }
}
