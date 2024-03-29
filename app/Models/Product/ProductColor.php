<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
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
     * Get the Product for the ProductColor.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    /**
     * Get the Kit for the ProductType.
     */
    public function kits()
    {
        return $this->hasMany(Kit::class);
    }
}
