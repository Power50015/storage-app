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
        return $this->belongsTo(User::class, 'user');
    }
    /**
     * Get the Customer for the OutgoingInvoice.
     */
    public function customer()
    {
        return $this->belongsTo(People::class, 'customer');
    }
    /**
     * Get the cash for the OutgoingInvoice.
     */
    public function cash_type()
    {
        return $this->belongsTo(Cash::class, 'cash_type');
    }
     /**
     * Get the warehouses for the OutgoingInvoice.
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse');
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
