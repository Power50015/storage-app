<?php

namespace App\Http\Controllers;

use App\Models\DebtorPayAttachment;
use App\Http\Requests\StoreDebtorPayAttachmentRequest;
use App\Http\Requests\UpdateDebtorPayAttachmentRequest;

class DebtorPayAttachmentController extends Controller
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
     * @param  \App\Http\Requests\StoreDebtorPayAttachmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDebtorPayAttachmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DebtorPayAttachment  $debtorPayAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(DebtorPayAttachment $debtorPayAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DebtorPayAttachment  $debtorPayAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(DebtorPayAttachment $debtorPayAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDebtorPayAttachmentRequest  $request
     * @param  \App\Models\DebtorPayAttachment  $debtorPayAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDebtorPayAttachmentRequest $request, DebtorPayAttachment $debtorPayAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DebtorPayAttachment  $debtorPayAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(DebtorPayAttachment $debtorPayAttachment)
    {
        //
    }
}
