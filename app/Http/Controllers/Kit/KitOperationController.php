<?php

namespace App\Http\Controllers;

use App\Models\KitOperation;
use App\Http\Requests\StoreKitOperationRequest;
use App\Http\Requests\UpdateKitOperationRequest;

class KitOperationController extends Controller
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
     * @param  \App\Http\Requests\StoreKitOperationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKitOperationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KitOperation  $kitOperation
     * @return \Illuminate\Http\Response
     */
    public function show(KitOperation $kitOperation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KitOperation  $kitOperation
     * @return \Illuminate\Http\Response
     */
    public function edit(KitOperation $kitOperation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKitOperationRequest  $request
     * @param  \App\Models\KitOperation  $kitOperation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKitOperationRequest $request, KitOperation $kitOperation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KitOperation  $kitOperation
     * @return \Illuminate\Http\Response
     */
    public function destroy(KitOperation $kitOperation)
    {
        //
    }
}
