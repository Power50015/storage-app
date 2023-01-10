<?php

namespace App\Models\Product;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCollection extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the users for the ProductCollection.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the ProductCollection for the ProductBrand.
     */
    public function product_brand()
    {
        return $this->belongsTo(ProductBrand::class);
    }

    /**
     * Get the Product for the ProductCollection.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the ProductModel for the ProductCollection.
     */
    public function product_models()
    {
        return $this->hasMany(ProductModel::class);
    }

    /**
     * Get the Kit for the ProductType.
     */
    public function kits()
    {
        return $this->hasMany(Kit::class);
    }
}
