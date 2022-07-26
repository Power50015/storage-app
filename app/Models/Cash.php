<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cash extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the users for the Cashs.
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the IncomingInvoice for the Cashs.
     */
    public function incoming_invoices()
    {
        return $this->hasMany(IncomingInvoice::class);
    }

    /**
     * Get the OutgoingInvoice for the Cashs.
     */
    public function outgoing_invoices()
    {
        return $this->hasMany(OutgoingInvoice::class);
    }
}
