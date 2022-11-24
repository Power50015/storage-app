<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\Warehouse\WarehouseStockAttachment;
use App\Http\Requests\Warehouse\StoreWarehouseStockAttachmentRequest;
use App\Http\Requests\Warehouse\UpdateWarehouseStockAttachmentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class WarehouseStockAttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $file = Request::input('id');
        $search = Request::input('search');
        return [
            "attachment" => WarehouseStockAttachment::with('user')->latest()->where('warehouse_stock_id', $file)->when(Request::input('search'), function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })->paginate()->withQueryString(),
            "filters" => $search
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
     * @param  \App\Http\Requests\StoreWarehouseStockAttachmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWarehouseStockAttachmentRequest $request)
    {
        $attachment_path = $request["attachment"]->store('attachment/warehouse', 'public');
        WarehouseStockAttachment::create([
            'attachment' =>  $attachment_path,
            'warehouse_stock_id' => $request->id,
            'title' => $request->title,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WarehouseStockAttachment  $warehouseStockAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(WarehouseStockAttachment $warehouseStockAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WarehouseStockAttachment  $warehouseStockAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(WarehouseStockAttachment $warehouseStockAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWarehouseStockAttachmentRequest  $request
     * @param  \App\Models\WarehouseStockAttachment  $warehouseStockAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWarehouseStockAttachmentRequest $request, WarehouseStockAttachment $warehouseStockAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WarehouseStockAttachment  $warehouseStockAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(WarehouseStockAttachment $warehouseStockAttachment)
    {
        Storage::delete("public/" . $warehouseStockAttachment["attachment"]);
        $warehouseStockAttachment->delete();

        return Redirect::back();
    }
}
