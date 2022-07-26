<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitOperation extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the users for the KitOperation.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the kit for the KitOperation.
     */
    public function kit()
    {
        return $this->belongsTo(Kit::class);
    }

    /**
     * Get the warehouse for the KitOperation.
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
