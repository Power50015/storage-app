<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\Warehouse\WarehouseImage;
use App\Http\Requests\Warehouse\StoreWarehouseImageRequest;
use App\Http\Requests\Warehouse\UpdateWarehouseImageRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class WarehouseImageController extends Controller
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
            "image" => WarehouseImage::where('warehouse_id', $image)->with('user')->latest()->paginate()
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
     * @param  \App\Http\Requests\StoreWarehouseImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWarehouseImageRequest $request)
    {
        WarehouseImage::create([
            'image' =>  $request["image"]->store('image/warehouse', 'public'),
            'warehouse_id' => $request->id,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WarehouseImage  $warehouseImage
     * @return \Illuminate\Http\Response
     */
    public function show(WarehouseImage $warehouseImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WarehouseImage  $warehouseImage
     * @return \Illuminate\Http\Response
     */
    public function edit(WarehouseImage $warehouseImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWarehouseImageRequest  $request
     * @param  \App\Models\WarehouseImage  $warehouseImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWarehouseImageRequest $request, WarehouseImage $warehouseImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WarehouseImage  $warehouseImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(WarehouseImage $warehouseImage)
    {
        Storage::delete("public/" . $warehouseImage["image"]);
        $warehouseImage->delete();

        return Redirect::back();
    }
}
