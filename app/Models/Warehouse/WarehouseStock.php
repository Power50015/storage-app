<?php

namespace App\Models\Warehouse;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseStock extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the users for the IncomingInvoice.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

     /**
     * Get the warehouses for the warehouses.
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    /** 
    * Get the WarehouseStockAttachment for the OutgoingInvoice.
    */
   public function warehouse_stock_attachments()
   {
       return $this->hasMany(WarehouseStockAttachment::class);
   }

   /**
    * Get the WarehouseStockContent for the OutgoingInvoice.
    */
   public function warehouse_stock_contents()
   {
       return $this->hasMany(WarehouseStockContent::class);
   }

   /**
    * Get the WarehouseStockContent for the OutgoingInvoice.
    */
    public function kit_stocks()
    {
        return $this->hasMany(KitStock::class);
    }
   
}
