<?php

namespace App\Models\OutgoingInvoice;

use App\Models\People\People;
use App\Models\Product\Product;
use App\Models\User;
use App\Models\Warehouse\Warehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutgoingInvoiceContent extends Model
{
    use HasFactory;
    protected $guarded = [];
     /**
     * Get the users for the OutgoingInvoiceContent.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the incoming invoice for the OutgoingInvoiceContent.
     */
    public function outgoing_invoice()
    {
        return $this->belongsTo(OutgoingInvoice::class);
    }
    /**
     * Get the product for the OutgoingInvoiceContent.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    /**
     * Get the People for the IncomingInvoice.
     */
    public function people()
    {
        return $this->belongsTo(People::class);
    }

    /**
     * Get the warehouses for the IncomingInvoice.
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

}
