<?php

namespace App\Http\Controllers\Transfer;

use App\Http\Controllers\Controller;
use App\Models\Transfer\TransferAttachment;
use App\Http\Requests\Transfer\StoreTransferAttachmentRequest;
use App\Http\Requests\Transfer\UpdateTransferAttachmentRequest;

class TransferAttachmentController extends Controller
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
     * @param  \App\Http\Requests\StoreTransferAttachmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransferAttachmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransferAttachment  $transferAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(TransferAttachment $transferAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransferAttachment  $transferAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(TransferAttachment $transferAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransferAttachmentRequest  $request
     * @param  \App\Models\TransferAttachment  $transferAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransferAttachmentRequest $request, TransferAttachment $transferAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransferAttachment  $transferAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransferAttachment $transferAttachment)
    {
        //
    }
}
