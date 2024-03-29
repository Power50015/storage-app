<?php

namespace App\Models\Warehouse;

use App\Models\Product\Product;
use App\Models\User;
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
        return $this->belongsTo(User::class);
    }

    /**
     * Get the incoming invoice for the IncomingInvoiceContent.
     */
    public function warehouse_stock()
    {
        return $this->belongsTo(WarehouseStock::class);
    }
    
    /**
     * Get the product for the IncomingInvoiceContent.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
/**
     * Get the warehouses for the ReturnedIncomingInvoiceContent.
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
 
}
