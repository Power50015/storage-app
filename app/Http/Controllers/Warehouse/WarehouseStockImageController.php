<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Requests\Warehouse\StoreWarehouseStockImageRequest;
use App\Http\Requests\Warehouse\UpdateWarehouseStockImageRequest;
use App\Models\Warehouse\WarehouseStockImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class WarehouseStockImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $image = Request::input('id');
        return [
            "image" => WarehouseStockImage::where('warehouse_stock_id', $image)->with('user')->latest()->paginate()
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWarehouseStockImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWarehouseStockImageRequest $request)
    {
        WarehouseStockImage::create([
            'image' =>  $request["image"]->store('image/warehouse_stock', 'public'),
            'warehouse_stock_id' => $request->id,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WarehouseStockImage  $warehouseStockImage
     * @return \Illuminate\Http\Response
     */
    public function show(WarehouseStockImage $warehouseStockImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WarehouseStockImage  $warehouseStockImage
     * @return \Illuminate\Http\Response
     */
    public function edit(WarehouseStockImage $warehouseStockImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWarehouseStockImageRequest  $request
     * @param  \App\Models\WarehouseStockImage  $warehouseStockImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWarehouseStockImageRequest $request, WarehouseStockImage $warehouseStockImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WarehouseStockImage  $warehouseStockImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(WarehouseStockImage $warehouseStockImage)
    {
        Storage::delete("public/" . $warehouseStockImage["image"]);
        $warehouseStockImage->delete();

        return Redirect::back();
    }
}
