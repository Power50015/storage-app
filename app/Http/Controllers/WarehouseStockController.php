<?php

namespace App\Http\Controllers;

use App\Models\WarehouseStock;
use App\Http\Requests\StoreWarehouseStockRequest;
use App\Http\Requests\UpdateWarehouseStockRequest;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\WarehouseStockAttachment;
use App\Models\WarehouseStockContent;
use Illuminate\Support\Facades\Auth;
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
        return Inertia::render('Warehouse/WarehouseStock', [
            "products" => Product::with('country', 'material', 'color', 'model', 'collection', 'brand', 'type', 'category')->get(),
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
            'warehouse' => $request->warehouses,
            'user' => Auth::id()
        ]);

        // Save Attachment Of Incoming Invoice
        for ($i = 0; $i <  count($request["attachment"]); $i++) {
            if ($request["attachment"][1]["attachment"] != null) {
                $attachment_path = $request["attachment"][$i]["attachment"]->store('attachment/warehouseStock', 'public');
                WarehouseStockAttachment::create([
                    'attachment' =>  $attachment_path,
                    'warehouse_stocks' => $invice['id'],
                    'user' => Auth::id()
                ]);
            }
        }

        // Save The Content Of Incoming Invoice
        for ($i = 0; $i <  count($request["content"]); $i++) {
            WarehouseStockContent::create([
                'product' => $request["content"][$i]["product"],
                'quantity' => $request["content"][$i]["quantity"],
                'warehouse_stocks' => $invice['id'],
                'user' => Auth::id()
            ]);
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
