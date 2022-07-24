<?php

namespace App\Models;

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
        return $this->belongsTo(User::class, 'user');
    }

    /**
     * Get the ProductModel for the ProductCollection.
     */
    public function product_collections()
    {
        return $this->belongsTo(ProductCollection::class, 'product_collection');
    }

    /**
     * Get the Product for the ProductModel.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
