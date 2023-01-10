<?php

namespace App\Models\IncomingInvoice;

use App\Models\Cash\Cash;
use App\Models\People\People;

use App\Models\User;
use App\Models\Warehouse\Warehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingInvoice extends Model
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
     * Get the IncomingInvoiceAttachment for the user.
     */
    public function incoming_invoice_attachments()
    {
        return $this->hasMany(IncomingInvoiceAttachment::class);
    }
    /**
     * Get the IncomingInvoiceNote for the user.
     */
    public function incoming_invoice_notes()
    {
        return $this->hasMany(IncomingInvoiceNote::class);
    }
    /**
     * Get the IncomingInvoiceImage for the user.
     */
    public function incoming_invoice_images()
    {
        return $this->hasMany(IncomingInvoiceImage::class);
    }

    /**
     * Get the IncomingInvoiceContent for the IncomingInvoice.
     */
    public function incoming_invoice_contents()
    {
        return $this->hasMany(IncomingInvoiceContent::class);
    }
    /**
     * Get the IncomingInvoiceKit for the IncomingInvoice.
     */
    public function incoming_invoice_kits()
    {
        return $this->hasMany(IncomingInvoiceKit::class);
    }
}
