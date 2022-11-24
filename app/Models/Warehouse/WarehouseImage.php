<?php

namespace App\Models\Warehouse;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseImage extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
    * Get the users for the people.
    */
   public function user()
   {
       return $this->belongsTo(User::class);
   }
    /**
    * Get the note for the warehouse.
    */
   public function warehouse()
   {
       return $this->belongsTo(Warehouse::class);
   }

}
