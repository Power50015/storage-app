<?php

namespace App\Http\Controllers;

use App\Models\IncomingInvoiceContent;
use App\Http\Requests\StoreIncomingInvoiceContentRequest;
use App\Http\Requests\UpdateIncomingInvoiceContentRequest;

class IncomingInvoiceContentController extends Controller
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
     * @param  \App\Http\Requests\StoreIncomingInvoiceContentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIncomingInvoiceContentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IncomingInvoiceContent  $incomingInvoiceContent
     * @return \Illuminate\Http\Response
     */
    public function show(IncomingInvoiceContent $incomingInvoiceContent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IncomingInvoiceContent  $incomingInvoiceContent
     * @return \Illuminate\Http\Response
     */
    public function edit(IncomingInvoiceContent $incomingInvoiceContent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIncomingInvoiceContentRequest  $request
     * @param  \App\Models\IncomingInvoiceContent  $incomingInvoiceContent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIncomingInvoiceContentRequest $request, IncomingInvoiceContent $incomingInvoiceContent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IncomingInvoiceContent  $incomingInvoiceContent
     * @return \Illuminate\Http\Response
     */
    public function destroy(IncomingInvoiceContent $incomingInvoiceContent)
    {
        //
    }
}
