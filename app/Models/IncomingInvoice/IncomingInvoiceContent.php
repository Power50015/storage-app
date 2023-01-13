<?php

namespace App\Models\IncomingInvoice;

use App\Models\People\People;
use App\Models\Product\Product;
use App\Models\User;
use App\Models\Warehouse\Warehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingInvoiceContent extends Model
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
     * Get the incoming invoice for the IncomingInvoiceContent.
     */
    public function incoming_invoice()
    {
        return $this->belongsTo(IncomingInvoice::class);
    }
    /**
     * Get the product for the IncomingInvoiceContent.
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
