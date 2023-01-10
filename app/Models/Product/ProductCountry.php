<?php

namespace App\Models\Product;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCountry extends Model
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
     * Get the Product for the ProductCountry.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the ProductBrand for the ProductCountry.
     */
    public function product_brands()
    {
        return $this->hasMany(ProductBrand::class);
    }
    /**
     * Get the Kit for the ProductType.
     */
    public function kits()
    {
        return $this->hasMany(Kit::class);
    }
}
