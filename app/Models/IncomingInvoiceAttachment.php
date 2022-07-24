<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingInvoiceAttachment extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * Get the users for the IncomingInvoiceAttachment.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user');
    }

    /**
     * Get the incoming invoice for the IncomingInvoiceAttachment.
     */
    public function incoming_invoice()
    {
        return $this->belongsTo(IncomingInvoice::class, 'incoming_invoice');
    }
}
