<?php

namespace App\Http\Controllers\ReturnedIncomingInvoice;

use App\Http\Controllers\Controller;
use App\Models\ReturnedIncomingInvoiceNote;
use App\Http\Requests\ReturnedIncomingInvoice\StoreReturnedIncomingInvoiceNoteRequest;
use App\Http\Requests\ReturnedIncomingInvoice\UpdateReturnedIncomingInvoiceNoteRequest;

class ReturnedIncomingInvoiceNoteController extends Controller
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
     * @param  \App\Http\Requests\StoreReturnedIncomingInvoiceNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReturnedIncomingInvoiceNoteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnedIncomingInvoiceNote  $returnedIncomingInvoiceNote
     * @return \Illuminate\Http\Response
     */
    public function show(ReturnedIncomingInvoiceNote $returnedIncomingInvoiceNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnedIncomingInvoiceNote  $returnedIncomingInvoiceNote
     * @return \Illuminate\Http\Response
     */
    public function edit(ReturnedIncomingInvoiceNote $returnedIncomingInvoiceNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReturnedIncomingInvoiceNoteRequest  $request
     * @param  \App\Models\ReturnedIncomingInvoiceNote  $returnedIncomingInvoiceNote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReturnedIncomingInvoiceNoteRequest $request, ReturnedIncomingInvoiceNote $returnedIncomingInvoiceNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnedIncomingInvoiceNote  $returnedIncomingInvoiceNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturnedIncomingInvoiceNote $returnedIncomingInvoiceNote)
    {
        //
    }
}
