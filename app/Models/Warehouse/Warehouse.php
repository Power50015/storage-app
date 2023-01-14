<?php

namespace App\Models\Warehouse;

use App\Models\IncomingInvoice\IncomingInvoice;
use App\Models\IncomingInvoice\IncomingInvoiceContent;
use App\Models\IncomingInvoice\IncomingInvoiceKit;
use App\Models\Kit\KitOperation;
use App\Models\OutgoingInvoice\OutgoingInvoice;
use App\Models\OutgoingInvoice\OutgoingInvoiceContent;
use App\Models\OutgoingInvoice\OutgoingInvoiceKit;
use App\Models\Product\DestructibleGoods;
use App\Models\ReturnedIncomingInvoice\ReturnedIncomingInvoice;
use App\Models\ReturnedIncomingInvoice\ReturnedIncomingInvoiceContent;
use App\Models\ReturnedIncomingInvoice\ReturnedIncomingInvoiceKit;
use App\Models\ReturnedOutgoingInvoice\ReturnedOutgoingInvoice;
use App\Models\ReturnedOutgoingInvoice\ReturnedOutgoingInvoiceContent;
use App\Models\ReturnedOutgoingInvoice\ReturnedOutgoingInvoiceKit;
use App\Models\Transfer;
use App\Models\Transfer\TransferContent;
use App\Models\Transfer\TransferKit;
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
     * Get the incoming Invoice for the Warehouse.
     */
    public function incoming_invoice_contents()
    {
        return $this->hasMany(IncomingInvoiceContent::class);
    }

    /**
     * Get the Incoming Invoice Kit for the Warehouse.
     */
    public function incoming_invoice_kits()
    {
        return $this->hasMany(IncomingInvoiceKit::class);
    }

    /**
     * Get the Outgoing Invoice for the Warehouse.
     */
    public function outgoing_invoices()
    {
        return $this->hasMany(OutgoingInvoice::class);
    }

    /**
     * Get the Outgoing Invoice for the Warehouse.
     */
    public function outgoing_invoice_contents()
    {
        return $this->hasMany(OutgoingInvoiceContent::class);
    }

    /**
     * Get the Outgoing Invoice Kit for the Warehouse.
     */
    public function outgoing_invoice_kits()
    {
        return $this->hasMany(OutgoingInvoiceKit::class);
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
    public function transfer_content_tos()
    {
        return $this->hasMany(TransferContent::class, "warehouse_to_id");
    }

    /**
     * Get the Transfer From for the user.
     */
    public function transfer_content_froms()
    {
        return $this->hasMany(TransferContent::class, "warehouse_from_id");
    }
    /**
     * Get the Transfer To for the user.
     */
    public function transfer_kit_tos()
    {
        return $this->hasMany(TransferKit::class, "warehouse_to_id");
    }

    /**
     * Get the Transfer From for the user.
     */
    public function transfer_kit_froms()
    {
        return $this->hasMany(TransferKit::class, "warehouse_from_id");
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

    /**
     * Get the WarehouseStockContent for the OutgoingInvoice.
     */
    public function kit_stocks()
    {
        return $this->hasMany(KitStock::class);
    }

    /**
     * Get the ReturnedIncomingInvoice for the user.
     */
    public function returned_incoming_invoices()
    {
        return $this->hasMany(ReturnedIncomingInvoice::class);
    }
    /**
     * Get the ReturnedIncomingInvoiceContent for the user.
     */
    public function returned_incoming_invoice_contents()
    {
        return $this->hasMany(ReturnedIncomingInvoiceContent::class);
    }
    /**
     * Get the ReturnedIncomingInvoiceKit for the user.
     */
    public function returned_incoming_invoice_kits()
    {
        return $this->hasMany(ReturnedIncomingInvoiceKit::class);
    }

    /**
     * Get the ReturnedOutgoingInvoice for the user.
     */
    public function returned_outgoing_invoices()
    {
        return $this->hasMany(ReturnedOutgoingInvoice::class);
    }
    /**
     * Get the ReturnedOutgoingInvoiceContent for the user.
     */
    public function returned_outgoing_invoice_contents()
    {
        return $this->hasMany(ReturnedOutgoingInvoiceContent::class);
    }
    /**
     * Get the ReturnedOutgoingInvoiceKit for the user.
     */
    public function returned_outgoing_invoice_kits()
    {
        return $this->hasMany(ReturnedOutgoingInvoiceKit::class);
    }

    /**
     * Get the WarehouseStockContent for the Warehouse.
     */
    public function warehouse_stock_content()
    {
        return $this->belongsTo(WarehouseStockContent::class);
    }
}
