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
use Carbon\Carbon;
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
            "warehouses" => Warehouse::all(),
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
            'date' => Carbon::parse($request->date),
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
        return redirect()->route('warehouse.show',$invice['id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WarehouseStock  $warehouseStock
     * @return \Illuminate\Http\Response
     */
    public function show(WarehouseStock $warehouseStock)
    {
        return Inertia::render('WarehouseStock/Show', [
            "warehouseStock" => WarehouseStock::with(
                'warehouse',
                'user',
                'warehouse_stock_contents',
                'kit_stocks',
                'warehouse_stock_contents.product',
                'warehouse_stock_contents.product.product_category',
                'warehouse_stock_contents.product.product_type',
                'warehouse_stock_contents.product.product_brand',
                'warehouse_stock_contents.product.product_collection',
                'warehouse_stock_contents.product.product_model',
                'warehouse_stock_contents.product.product_color',
                'warehouse_stock_contents.product.product_material',
                'warehouse_stock_contents.product.product_country',
                'kit_stocks.kit',
                'kit_stocks.kit.product',
                'kit_stocks.kit.product.product_category',
                'kit_stocks.kit.product.product_type',
                'kit_stocks.kit.product.product_brand',
                'kit_stocks.kit.product.product_collection',
                'kit_stocks.kit.product.product_model',
                'kit_stocks.kit.product.product_color',
                'kit_stocks.kit.product.product_material',
                'kit_stocks.kit.product.product_country'
            )->where('id', $warehouseStock->id)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WarehouseStock  $warehouseStock
     * @return \Illuminate\Http\Response
     */
    public function edit(WarehouseStock $warehouseStock)
    {
        return Inertia::render('WarehouseStock/Create', [
            "warehouses" => Warehouse::all(),
            "warehouseStock" => $warehouseStock,
            "warehouseStockContent" => WarehouseStockContent::where('warehouse_stock_id', $warehouseStock->id)->get(),
            "kitStock" => KitStock::where('warehouse_stock_id', $warehouseStock->id)->get(),
        ]);
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
        $warehouseStock->title = $request->title;
        $warehouseStock->warehouse_id = $request->warehouses;
        WarehouseStockContent::where('warehouse_stock_id', $warehouseStock['id'])->delete();
        // Save The Content Of Incoming Invoice
        for ($i = 0; $i <  count($request["content"]); $i++) {
            WarehouseStockContent::create(array_merge(
                $request["content"][$i],
                ['warehouse_stock_id' => $warehouseStock['id'], 'user_id' => auth()->user()->id]
            ));
        }
        KitStock::where('warehouse_stock_id', $warehouseStock['id'])->delete();
        // Save The Kit Of Incoming Invoice
        for ($i = 0; $i <  count($request["kit"]); $i++) {
            KitStock::create(array_merge(
                $request["kit"][$i],
                ['warehouse_stock_id' => $warehouseStock['id'], 'user_id' => auth()->user()->id]
            ));
        }
        $warehouseStock->save();
        return Redirect::back();
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
