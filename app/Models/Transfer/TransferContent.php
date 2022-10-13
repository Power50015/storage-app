<?php

namespace App\Models\Transfer;

use App\Models\Product\Product;
use App\Models\User;
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
}
