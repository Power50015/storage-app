<?php

namespace App\Http\Controllers;

use App\Models\TransferContent;
use App\Http\Requests\StoreTransferContentRequest;
use App\Http\Requests\UpdateTransferContentRequest;

class TransferContentController extends Controller
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
     * @param  \App\Http\Requests\StoreTransferContentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransferContentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransferContent  $transferContent
     * @return \Illuminate\Http\Response
     */
    public function show(TransferContent $transferContent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransferContent  $transferContent
     * @return \Illuminate\Http\Response
     */
    public function edit(TransferContent $transferContent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransferContentRequest  $request
     * @param  \App\Models\TransferContent  $transferContent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransferContentRequest $request, TransferContent $transferContent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransferContent  $transferContent
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransferContent $transferContent)
    {
        //
    }
}
