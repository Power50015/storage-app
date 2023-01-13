<?php

namespace App\Models\ReturnedIncomingInvoice;

use App\Models\People\People;
use App\Models\Product\Product;
use App\Models\User;
use App\Models\Warehouse\Warehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnedIncomingInvoiceContent extends Model
{
    use HasFactory;

    protected $guarded = [];
    /**
     * Get the users for the ReturnedIncomingInvoiceContent.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the ReturnedIncomingInvoice for the user.
     */
    public function returned_incoming_invoice()
    {
        return $this->belongsTo(ReturnedIncomingInvoice::class);
    }

     /**
     * Get the warehouses for the ReturnedIncomingInvoiceContent.
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

     /**
     * Get the People for the ReturnedIncomingInvoiceContent.
     */
    public function people()
    {
        return $this->belongsTo(People::class);
    }

     /**
     * Get the Product for the ReturnedIncomingInvoiceContent.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
