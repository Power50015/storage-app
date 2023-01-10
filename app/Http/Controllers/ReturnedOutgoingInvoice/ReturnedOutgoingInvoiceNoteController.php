<?php

namespace App\Http\Controllers\ReturnedOutgoingInvoice;

use App\Http\Controllers\Controller;
use App\Models\ReturnedOutgoingInvoiceNote;
use App\Http\Requests\ReturnedOutgoingInvoice\StoreReturnedOutgoingInvoiceNoteRequest;
use App\Http\Requests\ReturnedOutgoingInvoice\UpdateReturnedOutgoingInvoiceNoteRequest;

class ReturnedOutgoingInvoiceNoteController extends Controller
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
     * @param  \App\Http\Requests\StoreReturnedOutgoingInvoiceNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReturnedOutgoingInvoiceNoteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnedOutgoingInvoiceNote  $returnedOutgoingInvoiceNote
     * @return \Illuminate\Http\Response
     */
    public function show(ReturnedOutgoingInvoiceNote $returnedOutgoingInvoiceNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnedOutgoingInvoiceNote  $returnedOutgoingInvoiceNote
     * @return \Illuminate\Http\Response
     */
    public function edit(ReturnedOutgoingInvoiceNote $returnedOutgoingInvoiceNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReturnedOutgoingInvoiceNoteRequest  $request
     * @param  \App\Models\ReturnedOutgoingInvoiceNote  $returnedOutgoingInvoiceNote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReturnedOutgoingInvoiceNoteRequest $request, ReturnedOutgoingInvoiceNote $returnedOutgoingInvoiceNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnedOutgoingInvoiceNote  $returnedOutgoingInvoiceNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturnedOutgoingInvoiceNote $returnedOutgoingInvoiceNote)
    {
        //
    }
}
