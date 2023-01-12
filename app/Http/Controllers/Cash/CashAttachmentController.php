<?php

namespace App\Http\Controllers\Cash;

use App\Http\Controllers\Controller;
use App\Models\Cash\CashAttachment;
use App\Http\Requests\Cash\StoreCashAttachmentRequest;
use App\Http\Requests\Cash\UpdateCashAttachmentRequest;

class CashAttachmentController extends Controller
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
     * @param  \App\Http\Requests\StoreCashAttachmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCashAttachmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CashAttachment  $cashAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(CashAttachment $cashAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CashAttachment  $cashAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(CashAttachment $cashAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCashAttachmentRequest  $request
     * @param  \App\Models\CashAttachment  $cashAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCashAttachmentRequest $request, CashAttachment $cashAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashAttachment  $cashAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashAttachment $cashAttachment)
    {
        //
    }
}
