<?php

namespace App\Models\Product;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBrand extends Model
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
     * Get the ProductCountry for the ProductBrand.
     */
    public function product_country()
    {
        return $this->belongsTo(ProductCountry::class);
    }

    /**
     * Get the Product for the ProductBrand.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the ProductCollection for the ProductBrand.
     */
    public function product_collections()
    {
        return $this->hasMany(ProductCollection::class);
    }

    /**
     * Get the Kit for the ProductType.
     */
    public function kits()
    {
        return $this->hasMany(Kit::class);
    }
}
