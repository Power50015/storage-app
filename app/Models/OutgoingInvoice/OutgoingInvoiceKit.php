<?php

namespace App\Models\OutgoingInvoice;

use App\Models\Kit\Kit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutgoingInvoiceKit extends Model
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
     * Get the outgoing invoice for the IncomingInvoiceContent.
     */
    public function outgoing_invoice()
    {
        return $this->belongsTo(OutgoingInvoice::class);
    }
    /**
     * Get the product for the IncomingInvoiceContent.
     */
    public function kit()
    {
        return $this->belongsTo(Kit::class);
    }
}
