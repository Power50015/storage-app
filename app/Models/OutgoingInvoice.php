<?php

namespace App\Models;

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
    * Get the OutgoingInvoiceContent for the OutgoingInvoice.
    */
   public function outgoing_invoice_contents()
   {
       return $this->hasMany(OutgoingInvoiceContent::class);
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
