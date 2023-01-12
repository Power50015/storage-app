<?php

namespace App\Models\ReturnedOutgoingInvoice;

use App\Models\Cash\Cash;
use App\Models\People\People;
use App\Models\User;
use App\Models\Warehouse\Warehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnedOutgoingInvoice extends Model
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
     * Get the ReturnedOutgoingInvoiceAttachment for the user.
     */
    public function returned_outgoing_invoice_attachments()
    {
        return $this->hasMany(ReturnedOutgoingInvoiceAttachment::class);
    }
    /**
     * Get the ReturnedOutgoingInvoiceNote for the user.
     */
    public function returned_outgoing_invoice_notes()
    {
        return $this->hasMany(ReturnedOutgoingInvoiceNote::class);
    }
    /**
     * Get the ReturnedOutgoingInvoiceImage for the user.
     */
    public function returned_outgoing_invoice_images()
    {
        return $this->hasMany(ReturnedOutgoingInvoiceImage::class);
    }

    /**
     * Get the ReturnedOutgoingInvoiceContent for the OutgoingInvoice.
     */
    public function returned_outgoing_invoice_contents()
    {
        return $this->hasMany(ReturnedOutgoingInvoiceContent::class);
    }
    /**
     * Get the ReturnedOutgoingInvoiceKit for the OutgoingInvoice.
     */
    public function returned_outgoing_invoice_kits()
    {
        return $this->hasMany(ReturnedOutgoingInvoiceKit::class);
    }
}
