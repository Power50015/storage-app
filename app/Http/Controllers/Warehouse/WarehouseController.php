<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Requests\Warehouse\StoreWarehouseRequest;
use App\Http\Requests\Warehouse\UpdateWarehouseRequest;
use App\Models\Warehouse\Warehouse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Warehouse/Index', [
            "warehouses" => Warehouse::query()->when(Request::input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })->with('user')->paginate(20)->withQueryString(),
            'totalWarehouse' => Warehouse::count(),
            'totalEmptyWarehouse' => Warehouse::count(),
            'filters' => Request::only(['search'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Warehouse/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWarehouseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWarehouseRequest $request)
    {
        Warehouse::create($request->all());
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $warehouse)
    {
        // Get The Warehouse Data
        $warehouse = Warehouse::with(['outgoing_invoices', 'outgoing_invoices.people', 'incoming_invoices', 'incoming_invoices.people', 'warehouse_stocks', 'transfer_froms', 'transfer_froms.warehouse_to', 'transfer_tos', 'transfer_tos.warehouse_from'])->find($warehouse->id);
        return Inertia::render('Warehouse/ShowWarehouse', [
            "warehouse" => $warehouse
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse $warehouse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWarehouseRequest  $request
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWarehouseRequest $request, Warehouse $warehouse)
    {
        $warehouse = Warehouse::find($warehouse["id"]);
        $warehouse->name = $request->name;
        $warehouse->address = $request->address;
        $warehouse->save();
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse $warehouse)
    {
        //
    }
}
