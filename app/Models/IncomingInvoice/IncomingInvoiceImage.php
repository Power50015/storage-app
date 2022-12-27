<?php

namespace App\Models\IncomingInvoice;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingInvoiceImage extends Model
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
     * Get the incoming invoice for the IncomingInvoiceAttachment.
     */
    public function incoming_invoice()
    {
        return $this->belongsTo(IncomingInvoice::class);
    }
}
