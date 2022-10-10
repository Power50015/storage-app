<?php

namespace App\Models\Product;

use App\Models\IncomingInvoice\IncomingInvoice;
use App\Models\IncomingInvoice\IncomingInvoiceContent;
use App\Models\IncomingInvoice\ReturnedIncomingInvoice;
use App\Models\OutgoingInvoice\OutgoingInvoice\OutgoingInvoice;
use App\Models\OutgoingInvoice\OutgoingInvoice\OutgoingInvoiceContent;
use App\Models\OutgoingInvoice\OutgoingInvoice\ReturnedOutgoingInvoice;
use App\Models\Transfer;
use App\Models\TransferContent;
use App\Models\Warehouse\Warehouse;
use App\Models\Warehouse\WarehouseStock;
use App\Models\Warehouse\WarehouseStockContent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['total_number_of_product', 'total_number_of_product_warehouse', 'total_sales'];
    /**
     * Get the category for the Product.
     */
    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    /**
     * Get the type for the Product.
     */
    public function product_type()
    {
        return $this->belongsTo(ProductType::class);
    }

    /**
     * Get the brand for the Product.
     */
    public function product_brand()
    {
        return $this->belongsTo(ProductBrand::class);
    }

    /**
     * Get the collection for the Product.
     */
    public function product_collection()
    {
        return $this->belongsTo(ProductCollection::class);
    }

    /**
     * Get the model for the Product.
     */
    public function product_model()
    {
        return $this->belongsTo(ProductModel::class);
    }

    /**
     * Get the color for the Product.
     */
    public function product_color()
    {
        return $this->belongsTo(ProductColor::class);
    }

    /**
     * Get the material for the Product.
     */
    public function product_material()
    {
        return $this->belongsTo(ProductMaterial::class);
    }

    /**
     * Get the country for the Product.
     */
    public function product_country()
    {
        return $this->belongsTo(ProductCountry::class);
    }

    /**
     * Get the users for the Product.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the IncomingInvoiceContent for the Product.
     */
    public function incoming_invoice_contents()
    {
        return $this->hasMany(IncomingInvoiceContent::class);
    }

    /**
     * Get the ReturnedIncomingInvoice for the Product.
     */
    public function returned_incoming_invoices()
    {
        return $this->hasMany(ReturnedIncomingInvoice::class);
    }
    /**
     * Get the OutgoingInvoiceContent for the Product.
     */
    public function outgoing_invoice_contents()
    {
        return $this->hasMany(OutgoingInvoiceContent::class);
    }
    /**
     * Get the ReturnedOutgoingInvoice for the user.
     */
    public function returned_outgoing_invoices()
    {
        return $this->hasMany(ReturnedOutgoingInvoice::class);
    }
    /**
     * Get the WarehouseStockContent for the Product.
     */
    public function warehouse_stock_contents()
    {
        return $this->hasMany(WarehouseStockContent::class);
    }

    /**
     * Get the TransferContent for the Product.
     */
    public function transfer_contents()
    {
        return $this->hasMany(TransferContent::class);
    }

    /**
     * Get the kit for the product.
     */
    public function kits()
    {
        return $this->hasMany(Kit::class);
    }

    /**
     * Get the ProductNote for the product.
     */
    public function product_notes()
    {
        return $this->hasMany(ProductNote::class);
    }

    /**
     * Get the ProductImage for the product.
     */
    public function product_images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Get the ProductAttachment for the product.
     */
    public function product_attachments()
    {
        return $this->hasMany(ProductAttachment::class);
    }
    /**
     * Get the Total Number Product.
     */
    public function getTotalNumberOfProductAttribute()
    {
        // return (IncomingInvoiceContent::where('product_id', $this->id)->sum('quantity') - ReturnedIncomingInvoice::where('product_id', $this->id)->sum('quantity')) + WarehouseStockContent::where('product_id', $this->id)->sum('quantity') - (OutgoingInvoiceContent::where('product_id', $this->id)->sum('quantity') - ReturnedOutgoingInvoice::where('product_id', $this->id)->sum('quantity'));
    }
    /**
     * Get the Total Number Product in Warehuose.
     */
    public function getTotalNumberOfProductWarehouseAttribute()
    {
        return 0;
        //     $warehouses = Warehouse::all();

        //     $data = [];

        //     // where warehouse is
        //     foreach ($warehouses as $key => $value) {


        //         // Get The income invoice numbers
        //         $incoming_invoices = IncomingInvoice::where('warehouse_id', $warehouses[$key]['id'])->get()->map->only('id');
        //         $transfers_to = Transfer::where('warehouse_to_id', $warehouses[$key]['id'])->get()->map->only('id');
        //         $warehouse_stocks = WarehouseStock::where('warehouse_id', $warehouses[$key]['id'])->get()->map->only('id');
        //         $incoming_invoice_id = [];

        //         foreach ($incoming_invoices as $key1 => $value1) {
        //             $incoming_invoice_id[] = $incoming_invoices[$key1]["id"];
        //         }
        //         // Get The income product quantity
        //         $incoming_q =
        //             (IncomingInvoiceContent::whereIn('incoming_invoice_id', $incoming_invoice_id)->where('product_id', $this->id)->sum('quantity')
        //                 - ReturnedIncomingInvoice::whereIn('incoming_invoice_id', $incoming_invoice_id)->where('product_id', $this->id)->sum('quantity')
        //             ) + WarehouseStockContent::where('product_id', $this->id)->whereIn('warehouse_stock_id', $warehouse_stocks)->sum('quantity') + TransferContent::whereIn('transfer_id', $transfers_to)->where('product_id', $this->id)->sum('quantity');

        //         // Get The Outgoing invoice numbers
        //         $outgoing_invoices = OutgoingInvoice::where('warehouse_id', $warehouses[$key]['id'])->get()->map->only('id');
        //         $transfers_from = Transfer::where('warehouse_from_id', $warehouses[$key]['id'])->get()->map->only('id');
        //         $outgoing_invoice_id = [];
        //         foreach ($outgoing_invoices as $key2 => $value2) {
        //             $outgoing_invoice_id[] = $outgoing_invoices[$key2]["id"];
        //         }

        //         // Get The Outgoing invoice product quantity
        //         $outgoing_q = (OutgoingInvoiceContent::whereIn('outgoing_invoice_id', $outgoing_invoice_id)->where('product_id', $this->id)->sum('quantity') - ReturnedOutgoingInvoice::whereIn('outgoing_invoice_id', $outgoing_invoice_id)->where('product_id', $this->id)->sum('quantity')) + TransferContent::whereIn('transfer_id', $transfers_from)->where('product_id', $this->id)->sum('quantity');

        //         if ($incoming_q - $outgoing_q > 0) {
        //             $data[] = [
        //                 "warehouse" => $warehouses[$key],
        //                 "quantity" => $incoming_q - $outgoing_q
        //             ];
        //         }
        //     }


        //     $data = collect($data);
        //     $data = $data->sortByDesc('quantity');
        //     return $data->values()->all();
    }
    /**
     * Get the totla sales Number Product.
     */
    public function getTotalSalesAttribute()
    {
        // return (OutgoingInvoiceContent::where('product_id', $this->id)->sum('quantity') - ReturnedOutgoingInvoice::where('product_id', $this->id)->sum('quantity'));
    }
}
