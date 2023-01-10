<?php

namespace App\Models\Transfer;

use App\Models\Product\Product;
use App\Models\User;
use App\Models\Warehouse\Warehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferContent extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * Get the users for the TransferContent.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the users for the Product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the users for the Transfer.
     */
    public function transfer()
    {
        return $this->belongsTo(Transfer::class);
    }

     /**
     * Get the warehouse_from for the Transfer.
     */
    public function warehouse_from()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_from_id');
    }
    /**
     * Get the warehouse_to for the Transfer.
     */
    public function warehouse_to()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_to_id');
    }
}
