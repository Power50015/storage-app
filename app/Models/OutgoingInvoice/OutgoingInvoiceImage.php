<?php

namespace App\Models\OutgoingInvoice;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutgoingInvoiceImage extends Model
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
     * Get the outgoing invoice for the IncomingInvoiceAttachment.
     */
    public function outgoing_invoice()
    {
        return $this->belongsTo(OutgoingInvoice::class);
    }
}
