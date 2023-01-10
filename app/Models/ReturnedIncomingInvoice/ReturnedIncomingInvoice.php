<?php

namespace App\Models\ReturnedIncomingInvoice;

use App\Models\Cash\Cash;
use App\Models\People\People;
use App\Models\User;
use App\Models\Warehouse\Warehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnedIncomingInvoice extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the users for the IncomingInvoice.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the People for the IncomingInvoice.
     */
    public function people()
    {
        return $this->belongsTo(People::class);
    }
    /**
     * Get the cash for the IncomingInvoice.
     */
    public function cash()
    {
        return $this->belongsTo(Cash::class);
    }
    /**
     * Get the warehouses for the IncomingInvoice.
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

     /**
     * Get the ReturnedIncomingInvoiceAttachment for the user.
     */
    public function returned_incoming_invoice_attachments()
    {
        return $this->hasMany(ReturnedIncomingInvoiceAttachment::class);
    }
    /**
     * Get the ReturnedIncomingInvoiceNote for the user.
     */
    public function returned_incoming_invoice_notes()
    {
        return $this->hasMany(ReturnedIncomingInvoiceNote::class);
    }
    /**
     * Get the ReturnedIncomingInvoiceImage for the user.
     */
    public function returned_incoming_invoice_images()
    {
        return $this->hasMany(ReturnedIncomingInvoiceImage::class);
    }

    /**
     * Get the ReturnedIncomingInvoiceContent for the IncomingInvoice.
     */
    public function returned_incoming_invoice_contents()
    {
        return $this->hasMany(ReturnedIncomingInvoiceContent::class);
    }
    /**
     * Get the ReturnedIncomingInvoiceKit for the IncomingInvoice.
     */
    public function returned_incoming_invoice_kits()
    {
        return $this->hasMany(ReturnedIncomingInvoiceKit::class);
    }
}
