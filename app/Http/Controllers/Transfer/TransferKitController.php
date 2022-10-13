<?php

namespace App\Http\Controllers\Transfer;

use App\Http\Controllers\Controller;
use App\Models\Transfer\TransferKit;
use App\Http\Requests\Transfer\StoreTransferKitRequest;
use App\Http\Requests\Transfer\UpdateTransferKitRequest;

class TransferKitController extends Controller
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
     * @param  \App\Http\Requests\StoreTransferKitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransferKitRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OutgoingInvoice\TransferKit  $transferKit
     * @return \Illuminate\Http\Response
     */
    public function show(TransferKit $transferKit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OutgoingInvoice\TransferKit  $transferKit
     * @return \Illuminate\Http\Response
     */
    public function edit(TransferKit $transferKit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransferKitRequest  $request
     * @param  \App\Models\OutgoingInvoice\TransferKit  $transferKit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransferKitRequest $request, TransferKit $transferKit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OutgoingInvoice\TransferKit  $transferKit
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransferKit $transferKit)
    {
        //
    }
}
