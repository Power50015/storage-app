<?php

namespace App\Models\OutgoingInvoice;

use App\Models\Product\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnedOutgoingInvoice extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * Get the users for the OutgoingInvoice.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the Outgoing invoice for the OutgoingInvoice.
     */
    public function outgoing_invoice()
    {
        return $this->belongsTo(OutgoingInvoice::class);
    }
    /**
     * Get the product for the OutgoingInvoice.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
