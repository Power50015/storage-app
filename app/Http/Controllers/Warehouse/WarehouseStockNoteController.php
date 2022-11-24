<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\Warehouse\WarehouseStockNote;
use App\Http\Requests\Warehouse\StoreWarehouseStockNoteRequest;
use App\Http\Requests\Warehouse\UpdateWarehouseStockNoteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class WarehouseStockNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $note = Request::input('id');
        $search = Request::input('search');
        return [
            "note" => WarehouseStockNote::with('user')->latest()->where('warehouse_stock_id', $note)->when(Request::input('search'), function ($query, $search) {
                $query->where('tag', 'like', "%{$search}%")
                    ->orWhere('note', 'like', "%{$search}%");
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
     * @param  \App\Http\Requests\StoreWarehouseStockNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWarehouseStockNoteRequest $request)
    {
        WarehouseStockNote::create([
            'note' => $request->note,
            'warehouse_stock_id' => $request->id,
            'tag' => $request->tag,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WarehouseStockNote  $warehouseStockNote
     * @return \Illuminate\Http\Response
     */
    public function show(WarehouseStockNote $warehouseStockNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WarehouseStockNote  $warehouseStockNote
     * @return \Illuminate\Http\Response
     */
    public function edit(WarehouseStockNote $warehouseStockNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWarehouseStockNoteRequest  $request
     * @param  \App\Models\WarehouseStockNote  $warehouseStockNote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWarehouseStockNoteRequest $request, WarehouseStockNote $warehouseStockNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WarehouseStockNote  $warehouseStockNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(WarehouseStockNote $warehouseStockNote)
    {
        $warehouseStockNote->delete();

        return Redirect::back();
    }
}
