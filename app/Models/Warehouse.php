<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['stock_products'];

    /**
     * Get the users for the Warehouses.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
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
     * Get The Product Stocks the Warehouse have
     */
    public function getStockProductsAttribute()
    {
        $product = [];

        // Get The Stock Products Quantity
        // get all id of out incoming invoice
        $warehouse_stocks_id = array();
        for ($i = 0; $i < count($this->warehouse_stocks); $i++) {
            $warehouse_stocks_id[] = $this->warehouse_stocks[$i]['id'];
        }
        $warehouse_stocks_content = WarehouseStockContent::whereIn('warehouse_stock_id', $warehouse_stocks_id)->get();
        for ($i = 0; $i < count($warehouse_stocks_content); $i++) {
            $flag = true; // product not found
            foreach ($product as $key => $value) {
                if ($warehouse_stocks_content[$i]->product_id == $value['product_id']) {
                    // Product Founded
                    $flag = false; // Change Flag
                    $product[$key]['quantity'] += $warehouse_stocks_content[$i]->quantity;
                }
            }
            if ($flag) {
                array_push($product, ["product_id" => $warehouse_stocks_content[$i]->product_id, "quantity" =>  $warehouse_stocks_content[$i]->quantity]);
            }
        }

        // Get The Incoming Invoice Products Quantity
        // get all id of out incoming invoice
        $incoming_invoices_id = array();
        for ($i = 0; $i < count($this->incoming_invoices); $i++) {
            $incoming_invoices_id[] = $this->incoming_invoices[$i]['id'];
        }
        $incoming_invoices_content = IncomingInvoiceContent::whereIn('incoming_invoice_id', $incoming_invoices_id)->get();
        for ($i = 0; $i < count($incoming_invoices_content); $i++) {
            $flag = true; // product not found

            foreach ($product as $key => $value) {
                if ($incoming_invoices_content[$i]->product_id == $value['product_id']) {

                    // Product Founded
                    $flag = false; // Change Flag
                    $product[$key]['quantity'] += $incoming_invoices_content[$i]->quantity;
                }
            }
            if ($flag) {
                array_push($product, ["product_id" => $incoming_invoices_content[$i]->product_id, "quantity" => $incoming_invoices_content[$i]->quantity]);
            }
        }

        // Get The Outgoing Invoice Products Quantity
        // get all id of out going invoice
        $outgoing_invoices_id = array();
        for ($i = 0; $i < count($this->outgoing_invoices); $i++) {
            $outgoing_invoices_id[] = $this->outgoing_invoices[$i]['id'];
        }
        $outgoing_invoices_content = OutgoingInvoiceContent::whereIn('outgoing_invoice_id', $outgoing_invoices_id)->get();
        for ($i = 0; $i < count($outgoing_invoices_content); $i++) {
            $flag = true; // product not found
            foreach ($product as $key => $value) {
                if ($outgoing_invoices_content[$i]->product_id == $value['product_id']) {
                    // Product Founded
                    $flag = false; // Change Flag
                    $product[$key]['quantity'] -= $outgoing_invoices_content[$i]->quantity;
                }
            }
            if ($flag) {
                array_push($product, ["product_id" => $outgoing_invoices_content[$i]->product_id, "quantity" => -1 * $outgoing_invoices_content[$i]->quantity]);
            }
        }

        // Get The transfer From Products Quantity
        // get all id of out transfer
        $transfer_froms_id = array();
        for ($i = 0; $i < count($this->transfer_froms); $i++) {
            $transfer_froms_id[] = $this->transfer_froms[$i]['id'];
        }
        $transfer_froms_content = TransferContent::whereIn('transfer_id', $transfer_froms_id)->get();
        for ($i = 0; $i < count($transfer_froms_content); $i++) {
            $flag = true; // product not found

            foreach ($product as $key => $value) {
                if ($transfer_froms_content[$i]->product_id == $value['product_id']) {

                    // Product Founded
                    $flag = false; // Change Flag
                    $product[$key]['quantity'] -= $transfer_froms_content[$i]->quantity;
                }
            }
            if ($flag) {
                array_push($product, ["product_id" => $transfer_froms_content[$i]->product_id, "quantity" => -1 * $transfer_froms_content[$i]->quantity]);
            }
        }

        // Get The transfer To Products Quantity
        // get all id of in transfer
        $transfer_tos_id = array();
        for ($i = 0; $i < count($this->transfer_tos); $i++) {
            $transfer_tos_id[] = $this->transfer_tos[$i]['id'];
        }
        $transfer_tos_content = TransferContent::whereIn('transfer_id', $transfer_tos_id)->get();
        for ($i = 0; $i < count($transfer_tos_content); $i++) {
            $flag = true; // product not found
            foreach ($product as $key => $value) {
                if ($transfer_tos_content[$i]->product_id == $value['product_id']) {
                    // Product Founded
                    $flag = false; // Change Flag
                    $product[$key]['quantity'] += $transfer_tos_content[$i]->quantity;
                }
            }
            if ($flag) {
                array_push($product, ["product_id" => $transfer_tos_content[$i]->product_id, "quantity" =>  $transfer_tos_content[$i]->quantity]);
            }
        }

        $product_ids = array();
        foreach ($product as $key => $value) {
            $product_ids[] = $value['product_id'];
        }

        $productData = Product::with('product_country', 'product_material', 'product_color', 'product_model', 'product_collection', 'product_brand', 'product_type', 'product_category')->whereIn('id', $product_ids)->orderBy('name', 'desc')->get();

        $productStockData = array();

        for ($i = 0; $i < count($productData); $i++) {
            $productStockData[] = [
                "product_brand" => $productData[$i]->product_brand->name,
                "product_category" => $productData[$i]->product_category->name,
                "product_type" => $productData[$i]->product_type->name,
                "product_collection" => $productData[$i]->product_collection->name,
                "product_model" => $productData[$i]->product_model->name,
                "product_color" => $productData[$i]->product_color->name,
                "product_material" => $productData[$i]->product_material->name,
                "product_country" => $productData[$i]->product_country->name,
                "product_sku" => $productData[$i]->sku,
                "product_name" => $productData[$i]->name,
                "product_quantity" => $product[$i]['quantity']
            ];
        }

        return $productStockData;
    }
}
