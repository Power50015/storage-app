<?php

namespace App\Http\Controllers\ReturnedOutgoingInvoice;

use App\Http\Controllers\Controller;
use App\Models\ReturnedOutgoingInvoiceAttachment;
use App\Http\Requests\ReturnedOutgoingInvoice\StoreReturnedOutgoingInvoiceAttachmentRequest;
use App\Http\Requests\ReturnedOutgoingInvoice\UpdateReturnedOutgoingInvoiceAttachmentRequest;

class ReturnedOutgoingInvoiceAttachmentController extends Controller
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
     * @param  \App\Http\Requests\StoreReturnedOutgoingInvoiceAttachmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReturnedOutgoingInvoiceAttachmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnedOutgoingInvoiceAttachment  $returnedOutgoingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(ReturnedOutgoingInvoiceAttachment $returnedOutgoingInvoiceAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnedOutgoingInvoiceAttachment  $returnedOutgoingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(ReturnedOutgoingInvoiceAttachment $returnedOutgoingInvoiceAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReturnedOutgoingInvoiceAttachmentRequest  $request
     * @param  \App\Models\ReturnedOutgoingInvoiceAttachment  $returnedOutgoingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReturnedOutgoingInvoiceAttachmentRequest $request, ReturnedOutgoingInvoiceAttachment $returnedOutgoingInvoiceAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnedOutgoingInvoiceAttachment  $returnedOutgoingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturnedOutgoingInvoiceAttachment $returnedOutgoingInvoiceAttachment)
    {
        //
    }
}
