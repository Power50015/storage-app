<?php

namespace App\Http\Controllers;

use App\Models\ProductAttachment;
use App\Http\Requests\StoreProductAttachmentRequest;
use App\Http\Requests\UpdateProductAttachmentRequest;

class ProductAttachmentController extends Controller
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
     * @param  \App\Http\Requests\StoreProductAttachmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductAttachmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductAttachment  $productAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(ProductAttachment $productAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductAttachment  $productAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductAttachment $productAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductAttachmentRequest  $request
     * @param  \App\Models\ProductAttachment  $productAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductAttachmentRequest $request, ProductAttachment $productAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductAttachment  $productAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductAttachment $productAttachment)
    {
        //
    }
}
