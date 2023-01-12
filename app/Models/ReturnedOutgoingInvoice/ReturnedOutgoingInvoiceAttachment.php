<?php

namespace App\Models\ReturnedOutgoingInvoice;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnedOutgoingInvoiceAttachment extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * Get the users for the IncomingInvoiceAttachment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the ReturnedIncomingInvoice for the user.
     */
    public function returned_incoming_invoices()
    {
        return $this->hasMany(ReturnedOutgoingInvoice::class);
    }
}
