<?php

namespace App\Models\Product;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttachment extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * Get the users for the ProductImage.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the Product for the ProductImage.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
