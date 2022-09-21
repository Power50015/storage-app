<?php

namespace App\Http\Controllers;

use App\Models\KitStock;
use App\Http\Requests\StoreKitStockRequest;
use App\Http\Requests\UpdateKitStockRequest;

class KitStockController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreKitStockRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKitStockRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KitStock  $kitStock
     * @return \Illuminate\Http\Response
     */
    public function show(KitStock $kitStock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KitStock  $kitStock
     * @return \Illuminate\Http\Response
     */
    public function edit(KitStock $kitStock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKitStockRequest  $request
     * @param  \App\Models\KitStock  $kitStock
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKitStockRequest $request, KitStock $kitStock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KitStock  $kitStock
     * @return \Illuminate\Http\Response
     */
    public function destroy(KitStock $kitStock)
    {
        //
    }
}
