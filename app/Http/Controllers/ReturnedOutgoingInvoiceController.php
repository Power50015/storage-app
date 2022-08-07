<?php

namespace App\Http\Controllers;

use App\Models\ReturnedOutgoingInvoice;
use App\Http\Requests\StoreReturnedOutgoingInvoiceRequest;
use App\Http\Requests\UpdateReturnedOutgoingInvoiceRequest;

class ReturnedOutgoingInvoiceController extends Controller
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
     * @param  \App\Http\Requests\StoreReturnedOutgoingInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReturnedOutgoingInvoiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnedOutgoingInvoice  $returnedOutgoingInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(ReturnedOutgoingInvoice $returnedOutgoingInvoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnedOutgoingInvoice  $returnedOutgoingInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(ReturnedOutgoingInvoice $returnedOutgoingInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReturnedOutgoingInvoiceRequest  $request
     * @param  \App\Models\ReturnedOutgoingInvoice  $returnedOutgoingInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReturnedOutgoingInvoiceRequest $request, ReturnedOutgoingInvoice $returnedOutgoingInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnedOutgoingInvoice  $returnedOutgoingInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturnedOutgoingInvoice $returnedOutgoingInvoice)
    {
        //
    }
}
