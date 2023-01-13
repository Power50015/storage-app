<?php

namespace App\Models\ReturnedOutgoingInvoice;

use App\Models\Kit\Kit;
use App\Models\People\People;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnedOutgoingInvoiceKit extends Model
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
     * Get the ReturnedIncomingInvoice for the user.
     */
    public function returned_outgoing_invoice()
    {
        return $this->belongsTo(ReturnedOutgoingInvoice::class);
    }

    /**
     * Get the incoming invoice for the IncomingInvoiceContent.
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
    /**
     * Get the People for the IncomingInvoice.
     */
    public function people()
    {
        return $this->belongsTo(People::class);
    }
}
