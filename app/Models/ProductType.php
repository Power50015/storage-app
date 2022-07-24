<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
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
     * Get the ProductCategory for the ProductType.
     */
    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_categories');
    }

    /**
     * Get the Product for the ProductType.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
