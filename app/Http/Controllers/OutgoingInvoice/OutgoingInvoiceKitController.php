<?php

namespace App\Http\Controllers\OutgoingInvoice;

use App\Http\Controllers\Controller;
use App\Models\OutgoingInvoice\OutgoingInvoiceKit;
use App\Http\Requests\OutgoingInvoice\StoreOutgoingInvoiceKitRequest;
use App\Http\Requests\OutgoingInvoice\UpdateOutgoingInvoiceKitRequest;

class OutgoingInvoiceKitController extends Controller
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
     * @param  \App\Http\Requests\StoreOutgoingInvoiceKitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOutgoingInvoiceKitRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OutgoingInvoice\OutgoingInvoiceKit  $outgoingInvoiceKit
     * @return \Illuminate\Http\Response
     */
    public function show(OutgoingInvoiceKit $outgoingInvoiceKit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OutgoingInvoice\OutgoingInvoiceKit  $outgoingInvoiceKit
     * @return \Illuminate\Http\Response
     */
    public function edit(OutgoingInvoiceKit $outgoingInvoiceKit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOutgoingInvoiceKitRequest  $request
     * @param  \App\Models\OutgoingInvoice\OutgoingInvoiceKit  $outgoingInvoiceKit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOutgoingInvoiceKitRequest $request, OutgoingInvoiceKit $outgoingInvoiceKit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OutgoingInvoice\OutgoingInvoiceKit  $outgoingInvoiceKit
     * @return \Illuminate\Http\Response
     */
    public function destroy(OutgoingInvoiceKit $outgoingInvoiceKit)
    {
        //
    }
}
