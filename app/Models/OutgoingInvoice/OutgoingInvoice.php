<?php

namespace App\Models\OutgoingInvoice;

use App\Models\Cash\Cash;
use App\Models\People\People;
use App\Models\User;
use App\Models\Warehouse\Warehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutgoingInvoice extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the users for the OutgoingInvoice.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the People for the OutgoingInvoice.
     */
    public function people()
    {
        return $this->belongsTo(People::class);
    }
    /**
     * Get the cash for the OutgoingInvoice.
     */
    public function cash()
    {
        return $this->belongsTo(Cash::class);
    }
    /**
     * Get the warehouses for the OutgoingInvoice.
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    /** 
     * Get the OutgoingInvoiceAttachment for the OutgoingInvoice.
     */
    public function outgoing_invoice_attachments()
    {
        return $this->hasMany(OutgoingInvoiceAttachment::class);
    }

    /**
     * Get the OutgoingInvoiceImage for the user.
     */
    public function outgoing_invoice_images()
    {
        return $this->hasMany(OutgoingInvoiceImage::class);
    }
    /**
     * Get the OutgoingInvoiceNote for the user.
     */
    public function outgoing_invoice_notes()
    {
        return $this->hasMany(OutgoingInvoiceNote::class);
    }

    /**
     * Get the OutgoingInvoiceContent for the OutgoingInvoice.
     */
    public function outgoing_invoice_contents()
    {
        return $this->hasMany(OutgoingInvoiceContent::class);
    }
    /**
     * Get the OutgoingInvoiceKit for the OutgoingInvoice.
     */
    public function outgoing_invoice_kits()
    {
        return $this->hasMany(OutgoingInvoiceKit::class);
    }
    /**
     * Get the ReturnedOutgoingInvoice for the IncomingInvoice.
     */
    public function returned_outgoing_invoices()
    {
        return $this->hasMany(ReturnedOutgoingInvoice::class);
    }
    /**
     * Get the ReturnedIncomingInvoiceKit for the user.
     */
    public function returned_outgoing_invoice_kits()
    {
        return $this->hasMany(ReturnedOutgoingInvoiceKit::class);
    }
   
}
