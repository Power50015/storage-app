<?php

namespace App\Http\Controllers\Debtor;

use App\Http\Controllers\Controller;
use App\Models\Debtor\DebtorAttachment;
use App\Http\Requests\Debtor\StoreDebtorAttachmentRequest;
use App\Http\Requests\Debtor\UpdateDebtorAttachmentRequest;

class DebtorAttachmentController extends Controller
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
     * @param  \App\Http\Requests\StoreDebtorAttachmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDebtorAttachmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DebtorAttachment  $debtorAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(DebtorAttachment $debtorAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DebtorAttachment  $debtorAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(DebtorAttachment $debtorAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDebtorAttachmentRequest  $request
     * @param  \App\Models\DebtorAttachment  $debtorAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDebtorAttachmentRequest $request, DebtorAttachment $debtorAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DebtorAttachment  $debtorAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(DebtorAttachment $debtorAttachment)
    {
        //
    }
}
