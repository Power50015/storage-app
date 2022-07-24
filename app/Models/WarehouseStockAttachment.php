<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseStockAttachment extends Model
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
     * Get the warehouse_stock for the WarehouseStockAttachment.
     */
    public function warehouse_stock()
    {
        return $this->belongsTo(WarehouseStock::class, 'warehouse_stock');
    }

}
