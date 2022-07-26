<?php

namespace App\Models;

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
    public function cash_type()
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
     * Get the IncomingInvoiceAttachment for the IncomingInvoice.
     */
    public function incoming_invoice_attachments()
    {
        return $this->hasMany(IncomingInvoiceAttachment::class);
    }

    /**
     * Get the IncomingInvoiceContent for the IncomingInvoice.
     */
    public function incoming_invoice_contents()
    {
        return $this->hasMany(IncomingInvoiceContent::class);
    }
    
    /**
     * Get The Total Before Discount
    **/
    public function totalBeforeDiscount()
    {
        return 0;
    }
    /**
     * Get The Total After Discount
    **/
    public function totalAfterDiscount()
    {
        return 0;
    }
}
