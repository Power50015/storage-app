<?php

namespace App\Http\Controllers;

use App\Models\KitAttachment;
use App\Http\Requests\StoreKitAttachmentRequest;
use App\Http\Requests\UpdateKitAttachmentRequest;

class KitAttachmentController extends Controller
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
     * @param  \App\Http\Requests\StoreKitAttachmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKitAttachmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KitAttachment  $kitAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(KitAttachment $kitAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KitAttachment  $kitAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(KitAttachment $kitAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKitAttachmentRequest  $request
     * @param  \App\Models\KitAttachment  $kitAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKitAttachmentRequest $request, KitAttachment $kitAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KitAttachment  $kitAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(KitAttachment $kitAttachment)
    {
        //
    }
}
