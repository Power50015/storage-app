<?php

namespace App\Http\Controllers\Cash;

use App\Http\Controllers\Controller;
use App\Models\Cash\CashPayAttachment;
use App\Http\Requests\Cash\StoreCashPayAttachmentRequest;
use App\Http\Requests\Cash\UpdateCashPayAttachmentRequest;

class CashPayAttachmentController extends Controller
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
     * @param  \App\Http\Requests\StoreCashPayAttachmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCashPayAttachmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CashPayAttachment  $cashPayAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(CashPayAttachment $cashPayAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CashPayAttachment  $cashPayAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(CashPayAttachment $cashPayAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCashPayAttachmentRequest  $request
     * @param  \App\Models\CashPayAttachment  $cashPayAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCashPayAttachmentRequest $request, CashPayAttachment $cashPayAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashPayAttachment  $cashPayAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashPayAttachment $cashPayAttachment)
    {
        //
    }
}
