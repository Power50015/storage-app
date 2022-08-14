<?php

namespace App\Http\Controllers;

use App\Models\ProductAttachment;
use App\Http\Requests\StoreProductAttachmentRequest;
use App\Http\Requests\UpdateProductAttachmentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

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

        $attachment_path = $request["attachment"]->store('attachment/products', 'public');
        ProductAttachment::create([
            'attachment' =>  $attachment_path,
            'product_id' => $request->product_id,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
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
        $productAttachment::destroy($productAttachment->id);
        Storage::delete("public/" . $productAttachment["attachment"]);
        return Redirect::back();
    }
}
