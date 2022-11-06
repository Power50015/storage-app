<?php

namespace App\Http\Controllers\Creditor;

use App\Http\Controllers\Controller;
use App\Models\Creditor\CreditorAttachment;
use App\Http\Requests\Creditor\StoreCreditorAttachmentRequest;
use App\Http\Requests\Creditor\UpdateCreditorAttachmentRequest;

class CreditorAttachmentController extends Controller
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
     * @param  \App\Http\Requests\StoreCreditorAttachmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCreditorAttachmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CreditorAttachment  $creditorAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(CreditorAttachment $creditorAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CreditorAttachment  $creditorAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(CreditorAttachment $creditorAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCreditorAttachmentRequest  $request
     * @param  \App\Models\CreditorAttachment  $creditorAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCreditorAttachmentRequest $request, CreditorAttachment $creditorAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CreditorAttachment  $creditorAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(CreditorAttachment $creditorAttachment)
    {
        //
    }
}
