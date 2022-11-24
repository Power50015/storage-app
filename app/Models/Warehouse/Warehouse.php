<?php

namespace App\Models\Warehouse;

use App\Models\IncomingInvoice\IncomingInvoice;
use App\Models\IncomingInvoice\IncomingInvoiceContent;
use App\Models\IncomingInvoice\IncomingInvoiceKit;
use App\Models\IncomingInvoice\ReturnedIncomingInvoice;
use App\Models\IncomingInvoice\ReturnedIncomingInvoiceKit;
use App\Models\Kit\Kit;
use App\Models\Kit\KitOperation;
use App\Models\OutgoingInvoice\OutgoingInvoice;
use App\Models\OutgoingInvoice\OutgoingInvoiceContent;
use App\Models\OutgoingInvoice\OutgoingInvoiceKit;
use App\Models\OutgoingInvoice\ReturnedOutgoingInvoice;
use App\Models\OutgoingInvoice\ReturnedOutgoingInvoiceKit;
use App\Models\Product\DestructibleGoods;
use App\Models\Product\DestructibleGoodsAction;
use App\Models\Product\Product;
use App\Models\Transfer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * Get the users for the Warehouses.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the Warehouse for the user.
     */
    public function warehouse_notes()
    {
        return $this->hasMany(WarehouseNote::class);
    }
    /**
     * Get the Warehouse for the user.
     */
    public function warehouse_images()
    {
        return $this->hasMany(WarehouseImage::class);
    }
    /**
     * Get the Warehouse for the user.
     */
    public function warehouse_attachments()
    {
        return $this->hasMany(WarehouseAttachment::class);
    }
    /**
     * Get the IncomingInvoice for the Warehouse.
     */
    public function incoming_invoices()
    {
        return $this->hasMany(IncomingInvoice::class);
    }

    /**
     * Get the OutgoingInvoice for the Warehouse.
     */
    public function outgoing_invoices()
    {
        return $this->hasMany(OutgoingInvoice::class);
    }

    /**
     * Get the WarehouseStock for the Warehouse.
     */
    public function warehouse_stocks()
    {
        return $this->hasMany(WarehouseStock::class);
    }

    /**
     * Get the KitOperation for the user.
     */
    public function kit_operations()
    {
        return $this->hasMany(KitOperation::class);
    }

    /**
     * Get the Transfer From for the user.
     */
    public function transfer_froms()
    {
        return $this->hasMany(Transfer::class, "warehouse_from_id");
    }

    /**
     * Get the Transfer To for the user.
     */
    public function transfer_tos()
    {
        return $this->hasMany(Transfer::class, "warehouse_to_id");
    }

    /**
     * Get the DestructibleGoods for the product.
     */
    public function destructible_goods()
    {
        return $this->hasMany(DestructibleGoods::class);
    }
}
