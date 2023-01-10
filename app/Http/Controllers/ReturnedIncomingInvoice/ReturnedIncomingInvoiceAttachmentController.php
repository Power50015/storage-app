<?php

namespace App\Http\Controllers\ReturnedIncomingInvoice;

use App\Http\Controllers\Controller;
use App\Models\ReturnedIncomingInvoiceAttachment;
use App\Http\Requests\ReturnedIncomingInvoice\StoreReturnedIncomingInvoiceAttachmentRequest;
use App\Http\Requests\ReturnedIncomingInvoice\UpdateReturnedIncomingInvoiceAttachmentRequest;

class ReturnedIncomingInvoiceAttachmentController extends Controller
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
     * @param  \App\Http\Requests\StoreReturnedIncomingInvoiceAttachmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReturnedIncomingInvoiceAttachmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnedIncomingInvoiceAttachment  $returnedIncomingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(ReturnedIncomingInvoiceAttachment $returnedIncomingInvoiceAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnedIncomingInvoiceAttachment  $returnedIncomingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(ReturnedIncomingInvoiceAttachment $returnedIncomingInvoiceAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReturnedIncomingInvoiceAttachmentRequest  $request
     * @param  \App\Models\ReturnedIncomingInvoiceAttachment  $returnedIncomingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReturnedIncomingInvoiceAttachmentRequest $request, ReturnedIncomingInvoiceAttachment $returnedIncomingInvoiceAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnedIncomingInvoiceAttachment  $returnedIncomingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturnedIncomingInvoiceAttachment $returnedIncomingInvoiceAttachment)
    {
        //
    }
}
