<?php

namespace App\Http\Controllers\OutgoingInvoice;

use App\Http\Controllers\Controller;
use App\Models\OutgoingInvoice\OutgoingInvoiceAttachment;
use App\Http\Requests\OutgoingInvoice\StoreOutgoingInvoiceAttachmentRequest;
use App\Http\Requests\OutgoingInvoice\UpdateOutgoingInvoiceAttachmentRequest;

class OutgoingInvoiceAttachmentController extends Controller
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
     * @param  \App\Http\Requests\StoreOutgoingInvoiceAttachmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOutgoingInvoiceAttachmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OutgoingInvoiceAttachment  $outgoingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(OutgoingInvoiceAttachment $outgoingInvoiceAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OutgoingInvoiceAttachment  $outgoingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(OutgoingInvoiceAttachment $outgoingInvoiceAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOutgoingInvoiceAttachmentRequest  $request
     * @param  \App\Models\OutgoingInvoiceAttachment  $outgoingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOutgoingInvoiceAttachmentRequest $request, OutgoingInvoiceAttachment $outgoingInvoiceAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OutgoingInvoiceAttachment  $outgoingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(OutgoingInvoiceAttachment $outgoingInvoiceAttachment)
    {
        //
    }
}
