<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kit extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the users for the Kit.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the Products for the Kit.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the kitAttachment for the Kit.
     */
    public function kit_attachments()
    {
        return $this->hasMany(KitAttachment::class);
    }

    /**
     * Get the KitOperation for the kit.
     */
    public function kit_operations()
    {
        return $this->hasMany(KitOperation::class);
    }
}
