<?php

namespace App\Models\Product;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the users for the Warehouses.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the ProductCollection for the ProductModel.
     */
    public function product_collection()
    {
        return $this->belongsTo(ProductCollection::class);
    }

    /**
     * Get the Product for the ProductModel.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    
}
