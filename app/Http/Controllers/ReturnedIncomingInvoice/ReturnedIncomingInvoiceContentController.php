<?php

namespace App\Http\Controllers\ReturnedIncomingInvoice;

use App\Http\Controllers\Controller;
use App\Models\ReturnedIncomingInvoiceContent;
use App\Http\Requests\ReturnedIncomingInvoice\StoreReturnedIncomingInvoiceContentRequest;
use App\Http\Requests\ReturnedIncomingInvoice\UpdateReturnedIncomingInvoiceContentRequest;

class ReturnedIncomingInvoiceContentController extends Controller
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
     * @param  \App\Http\Requests\StoreReturnedIncomingInvoiceContentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReturnedIncomingInvoiceContentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnedIncomingInvoiceContent  $returnedIncomingInvoiceContent
     * @return \Illuminate\Http\Response
     */
    public function show(ReturnedIncomingInvoiceContent $returnedIncomingInvoiceContent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnedIncomingInvoiceContent  $returnedIncomingInvoiceContent
     * @return \Illuminate\Http\Response
     */
    public function edit(ReturnedIncomingInvoiceContent $returnedIncomingInvoiceContent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReturnedIncomingInvoiceContentRequest  $request
     * @param  \App\Models\ReturnedIncomingInvoiceContent  $returnedIncomingInvoiceContent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReturnedIncomingInvoiceContentRequest $request, ReturnedIncomingInvoiceContent $returnedIncomingInvoiceContent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnedIncomingInvoiceContent  $returnedIncomingInvoiceContent
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturnedIncomingInvoiceContent $returnedIncomingInvoiceContent)
    {
        //
    }
}
