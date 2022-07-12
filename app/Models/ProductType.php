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
    public function users()
    {
        return $this->belongsTo(User::class, 'user');
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class, 'product_categories');
    }
}
