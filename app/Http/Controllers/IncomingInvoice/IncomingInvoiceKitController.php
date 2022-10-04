<?php

namespace App\Http\Controllers\IncomingInvoice;

use App\Http\Controllers\Controller;
use App\Models\IncomingInvoice\IncomingInvoiceKit;
use App\Http\Requests\IncomingInvoice\StoreIncomingInvoiceKitRequest;
use App\Http\Requests\IncomingInvoice\UpdateIncomingInvoiceKitRequest;

class IncomingInvoiceKitController extends Controller
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
     * @param  \App\Http\Requests\StoreIncomingInvoiceKitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIncomingInvoiceKitRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IncomingInvoiceKit  $incomingInvoiceKit
     * @return \Illuminate\Http\Response
     */
    public function show(IncomingInvoiceKit $incomingInvoiceKit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IncomingInvoiceKit  $incomingInvoiceKit
     * @return \Illuminate\Http\Response
     */
    public function edit(IncomingInvoiceKit $incomingInvoiceKit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIncomingInvoiceKitRequest  $request
     * @param  \App\Models\IncomingInvoiceKit  $incomingInvoiceKit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIncomingInvoiceKitRequest $request, IncomingInvoiceKit $incomingInvoiceKit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IncomingInvoiceKit  $incomingInvoiceKit
     * @return \Illuminate\Http\Response
     */
    public function destroy(IncomingInvoiceKit $incomingInvoiceKit)
    {
        //
    }
}
