<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
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
     * Get the Product for the ProductCategory.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the ProductType for the ProductCategory.
     */
    public function product_types()
    {
        return $this->hasMany(ProductType::class);
    }
}
