<?php

namespace App\Models\Kit;

use App\Models\IncomingInvoice\IncomingInvoice;
use App\Models\IncomingInvoice\IncomingInvoiceKit;
use App\Models\Product\Product;
use App\Models\IncomingInvoice\ReturnedIncomingInvoiceKit;
use App\Models\OutgoingInvoice\OutgoingInvoiceKit;
use App\Models\OutgoingInvoice\ReturnedOutgoingInvoiceKit;
use App\Models\Transfer\TransferKit;
use App\Models\User;
use App\Models\Warehouse\KitStock;
use App\Models\Warehouse\Warehouse;
use App\Models\Warehouse\WarehouseStock;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kit extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['total_number_of_kit'];

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
    public function warehouse_stocks()
    {
        return $this->hasMany(WarehouseStock::class);
    }

    /**
     * Get the KitOperation for the kit.
     */
    public function kit_operations()
    {
        return $this->hasMany(KitOperation::class);
    }
    /**
     * Get the KitImage for the kit.
     */
    public function kit_images()
    {
        return $this->hasMany(KitImage::class);
    }
    /**
     * Get the KitNote for the kit.
     */
    public function kit_notes()
    {
        return $this->hasMany(KitNote::class);
    }
    /**
     * Get the Transfer To for the Transfer Kit.
     */
    public function transfer_kits()
    {
        return $this->hasMany(TransferKit::class);
    }
    /**
     * Get the IncomingInvoiceKit for the IncomingInvoice.
     */
    public function incoming_invoice_kits()
    {
        return $this->hasMany(IncomingInvoiceKit::class);
    }
    /**
     * Get the ReturnedIncomingInvoiceKit for the user.
     */
    public function returned_incoming_invoice_kits()
    {
        return $this->hasMany(ReturnedIncomingInvoiceKit::class);
    }
    /**
     * Get the ReturnedIncomingInvoiceKit for the user.
     */
    public function returned_outgoing_invoice_kits()
    {
        return $this->hasMany(ReturnedOutgoingInvoiceKit::class);
    }
    /**
     * Get the Total Number Product.
     */
    public function getTotalNumberOfKitAttribute()
    {
        $quantity = KitStock::where('kit_id', $this->id)->sum('quantity');
        $quantity += IncomingInvoiceKit::where('kit_id', $this->id)->sum('quantity');
        $quantity -= ReturnedIncomingInvoiceKit::where('kit_id', $this->id)->sum('quantity');
        $quantity -= OutgoingInvoiceKit::where('kit_id', $this->id)->sum('quantity');
        $quantity += ReturnedOutgoingInvoiceKit::where('kit_id', $this->id)->sum('quantity');
        $quantity -= KitOperation::where('kit_id', $this->id)->sum('quantity');

        return $quantity;
    }
}
