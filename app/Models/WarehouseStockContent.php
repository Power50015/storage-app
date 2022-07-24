<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseStockContent extends Model
{
    use HasFactory;
    protected $guarded = [];
     /**
     * Get the users for the IncomingInvoiceContent.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user');
    }

    /**
     * Get the incoming invoice for the IncomingInvoiceContent.
     */
    public function warehouse_stock()
    {
        return $this->belongsTo(WarehouseStock::class, 'warehouse_stocks');
    }
    /**
     * Get the product for the IncomingInvoiceContent.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product');
    }
}