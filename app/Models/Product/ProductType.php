<?php

namespace App\Models\Product;

use App\Models\Kit\Kit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the users for the ProductType.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the ProductCategory for the ProductType.
     */
    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    /**
     * Get the Product for the ProductType.
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
