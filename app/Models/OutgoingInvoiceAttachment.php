<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutgoingInvoiceAttachment extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * Get the users for the OutgoingInvoiceAttachment.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user');
    }

    /**
     * Get the outgoing invoice for the OutgoingInvoiceAttachment.
     */
    public function outgoing_invoice()
    {
        return $this->belongsTo(OutgoingInvoice::class, 'outgoing_invoice');
    }
}
