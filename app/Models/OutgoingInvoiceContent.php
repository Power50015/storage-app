<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutgoingInvoiceContent extends Model
{
    use HasFactory;
    protected $guarded = [];
     /**
     * Get the users for the OutgoingInvoiceContent.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user');
    }

    /**
     * Get the incoming invoice for the OutgoingInvoiceContent.
     */
    public function outgoing_invoice()
    {
        return $this->belongsTo(OutgoingInvoice::class, 'outgoing_invoice');
    }
    /**
     * Get the product for the OutgoingInvoiceContent.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product');
    }
}
