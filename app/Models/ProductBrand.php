<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBrand extends Model
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

    /**
     * Get the users for the Warehouses.
     */
    public function product_countries()
    {
        return $this->belongsTo(ProductCountry::class, 'country');
    }
}
