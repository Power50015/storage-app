<?php

namespace App\Http\Controllers\IncomingInvoice;

use App\Http\Controllers\Controller;
use App\Models\IncomingInvoice\IncomingInvoiceAttachment;
use App\Http\Requests\IncomingInvoice\StoreIncomingInvoiceAttachmentRequest;
use App\Http\Requests\IncomingInvoice\UpdateIncomingInvoiceAttachmentRequest;

class IncomingInvoiceAttachmentController extends Controller
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
     * @param  \App\Http\Requests\StoreIncomingInvoiceAttachmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIncomingInvoiceAttachmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IncomingInvoiceAttachment  $incomingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(IncomingInvoiceAttachment $incomingInvoiceAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IncomingInvoiceAttachment  $incomingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(IncomingInvoiceAttachment $incomingInvoiceAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIncomingInvoiceAttachmentRequest  $request
     * @param  \App\Models\IncomingInvoiceAttachment  $incomingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIncomingInvoiceAttachmentRequest $request, IncomingInvoiceAttachment $incomingInvoiceAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IncomingInvoiceAttachment  $incomingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(IncomingInvoiceAttachment $incomingInvoiceAttachment)
    {
        //
    }
}
