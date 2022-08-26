<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnedIncomingInvoiceKit extends Model
{
    use HasFactory;
    protected $guarded = [];
     /**
     * Get the users for the IncomingInvoiceContent.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the incoming invoice for the IncomingInvoiceContent.
     */
    public function incoming_invoice()
    {
        return $this->belongsTo(IncomingInvoice::class);
    }
    /**
     * Get the product for the IncomingInvoiceContent.
     */
    public function kit()
    {
        return $this->belongsTo(Kit::class);
    }
}
