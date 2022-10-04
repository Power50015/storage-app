<?php

namespace App\Models\Kit;

use App\Models\IncomingInvoice\IncomingInvoice;
use App\Models\IncomingInvoice\IncomingInvoiceKit;
use App\Models\Product\Product;
use App\Models\IncomingInvoice\ReturnedIncomingInvoiceKit;
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
    protected $appends = ['total_number_of_kit', 'total_number_of_kit_warehouse'];

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
     * Get the Total Number Product.
     */
    public function getTotalNumberOfKitAttribute()
    {
        return (IncomingInvoiceKit::where('kit_id', $this->id)->sum('quantity') - ReturnedIncomingInvoiceKit::where('kit_id', $this->id)->sum('quantity')) + KitStock::where('kit_id', $this->id)->sum('quantity');
    }
    /**
     * Get the Total Number Product in Warehuose.
     */
    public function getTotalNumberOfKitWarehouseAttribute()
    {
        return 0;
        // $warehouses = Warehouse::all();

        // $data = [];

        // // where warehouse is
        // foreach ($warehouses as $key => $value) {


        //     // Get The income invoice numbers
        //     $incoming_invoices = IncomingInvoice::where('warehouse_id', $warehouses[$key]['id'])->get()->map->only('id');
        //     $warehouse_stocks = WarehouseStock::where('warehouse_id', $warehouses[$key]['id'])->get()->map->only('id');
        //     $incoming_invoice_id = [];

        //     foreach ($incoming_invoices as $key1 => $value1) {
        //         $incoming_invoice_id[] = $incoming_invoices[$key1]["id"];
        //     }
        //     // Get The income product quantity
        //     $incoming_q =
        //         (IncomingInvoiceKit::whereIn('incoming_invoice_id', $incoming_invoice_id)->where('kit_id', $this->id)->sum('quantity')
        //             - ReturnedIncomingInvoiceKit::whereIn('incoming_invoice_id', $incoming_invoice_id)->where('kit_id', $this->id)->sum('quantity')
        //         ) + KitStock::where('kit_id', $this->id)->whereIn('warehouse_stock_id', $warehouse_stocks)->sum('quantity');

        //     $data[] = [
        //         "warehouse" => $warehouses[$key],
        //         "quantity" => $incoming_q
        //     ];
        // }


        // $data = collect($data);
        // $data = $data->sortByDesc('quantity');
        // return $data->values()->all();
    }
}
