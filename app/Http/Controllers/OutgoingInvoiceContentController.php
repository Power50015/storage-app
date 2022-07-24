<?php

namespace App\Http\Controllers;

use App\Models\OutgoingInvoiceContent;
use App\Http\Requests\StoreOutgoingInvoiceContentRequest;
use App\Http\Requests\UpdateOutgoingInvoiceContentRequest;

class OutgoingInvoiceContentController extends Controller
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
     * @param  \App\Http\Requests\StoreOutgoingInvoiceContentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOutgoingInvoiceContentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OutgoingInvoiceContent  $outgoingInvoiceContent
     * @return \Illuminate\Http\Response
     */
    public function show(OutgoingInvoiceContent $outgoingInvoiceContent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OutgoingInvoiceContent  $outgoingInvoiceContent
     * @return \Illuminate\Http\Response
     */
    public function edit(OutgoingInvoiceContent $outgoingInvoiceContent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOutgoingInvoiceContentRequest  $request
     * @param  \App\Models\OutgoingInvoiceContent  $outgoingInvoiceContent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOutgoingInvoiceContentRequest $request, OutgoingInvoiceContent $outgoingInvoiceContent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OutgoingInvoiceContent  $outgoingInvoiceContent
     * @return \Illuminate\Http\Response
     */
    public function destroy(OutgoingInvoiceContent $outgoingInvoiceContent)
    {
        //
    }
}
