<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductNote extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the users for the ProductNote.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the Product for the ProductNote.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
