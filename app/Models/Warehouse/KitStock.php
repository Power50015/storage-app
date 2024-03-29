<?php

namespace App\Models\Warehouse;

use App\Models\Kit\Kit;
use App\Models\User;
use App\Models\Warehouse\WarehouseStock;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitStock extends Model
{
    use HasFactory;
    protected $guarded = [];
     /**
     * Get the users for the IncomingInvoiceContent.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the incoming invoice for the IncomingInvoiceContent.
     */
    public function warehouse_stock()
    {
        return $this->belongsTo(WarehouseStock::class);
    }
    
    /**
     * Get the product for the IncomingInvoiceContent.
     */
    public function kit()
    {
        return $this->belongsTo(Kit::class);
    }

     /**
    * Get the note for the warehouse.
    */
   public function warehouse()
   {
       return $this->belongsTo(Warehouse::class);
   }
    
}
