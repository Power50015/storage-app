<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\Warehouse\WarehouseAttachment;
use App\Http\Requests\Warehouse\StoreWarehouseAttachmentRequest;
use App\Http\Requests\Warehouse\UpdateWarehouseAttachmentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class WarehouseAttachmentController extends Controller
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
            "attachment" => WarehouseAttachment::with('user')->latest()->where('warehouse_id', $file)->when(Request::input('search'), function ($query, $search) {
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
     * @param  \App\Http\Requests\StoreWarehouseAttachmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWarehouseAttachmentRequest $request)
    {
        $attachment_path = $request["attachment"]->store('attachment/warehouse', 'public');
        WarehouseAttachment::create([
            'attachment' =>  $attachment_path,
            'warehouse_id' => $request->id,
            'title' => $request->title,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WarehouseAttachment  $warehouseAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(WarehouseAttachment $warehouseAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WarehouseAttachment  $warehouseAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(WarehouseAttachment $warehouseAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWarehouseAttachmentRequest  $request
     * @param  \App\Models\WarehouseAttachment  $warehouseAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWarehouseAttachmentRequest $request, WarehouseAttachment $warehouseAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WarehouseAttachment  $warehouseAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(WarehouseAttachment $warehouseAttachment)
    {
        Storage::delete("public/" . $warehouseAttachment["attachment"]);
        $warehouseAttachment->delete();

        return Redirect::back();
    }
}
