<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;

use App\Http\Requests\Warehouse\StoreWarehouseStockRequest;
use App\Http\Requests\Warehouse\UpdateWarehouseStockRequest;
use App\Models\Warehouse\WarehouseStock;
use App\Models\Kit\Kit;
use App\Models\Product\Product;
use App\Models\Warehouse\KitStock;
use App\Models\Warehouse\Warehouse;
use App\Models\Warehouse\WarehouseStockContent;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class WarehouseStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('WarehouseStock/Create', [
            "products" => Product::with('product_country', 'product_material', 'product_color', 'product_model', 'product_collection', 'product_brand', 'product_type', 'product_category')->get(),
            "warehouses" => Warehouse::all(),
            "kits" => Kit::with('product', 'product.product_country', 'product.product_material', 'product.product_color', 'product.product_model', 'product.product_collection', 'product.product_brand', 'product.product_type', 'product.product_category')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWarehouseStockRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWarehouseStockRequest $request)
    {
        // Save the Incoming Invoice
        $invice = WarehouseStock::create([
            'title' => $request->title,
            'warehouse_id' => $request->warehouses,
            'user_id' => auth()->user()->id,
        ]);


        // Save The Content Of Incoming Invoice
        for ($i = 0; $i <  count($request["content"]); $i++) {
            WarehouseStockContent::create(array_merge(
                $request["content"][$i],
                ['warehouse_stock_id' => $invice['id'], 'user_id' => auth()->user()->id]
            ));
        }

        // Save The Kit Of Incoming Invoice
        for ($i = 0; $i <  count($request["kit"]); $i++) {
            KitStock::create(array_merge(
                $request["kit"][$i],
                ['warehouse_stock_id' => $invice['id'], 'user_id' => auth()->user()->id]
            ));
        }
        return redirect()->route('warehouse.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WarehouseStock  $warehouseStock
     * @return \Illuminate\Http\Response
     */
    public function show(WarehouseStock $warehouseStock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WarehouseStock  $warehouseStock
     * @return \Illuminate\Http\Response
     */
    public function edit(WarehouseStock $warehouseStock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWarehouseStockRequest  $request
     * @param  \App\Models\WarehouseStock  $warehouseStock
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWarehouseStockRequest $request, WarehouseStock $warehouseStock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WarehouseStock  $warehouseStock
     * @return \Illuminate\Http\Response
     */
    public function destroy(WarehouseStock $warehouseStock)
    {
        //
    }
}
