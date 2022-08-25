<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitImage extends Model
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
    * Get the kit for the Kit.
    */
   public function kit()
   {
       return $this->belongsTo(Kit::class);
   }
}
