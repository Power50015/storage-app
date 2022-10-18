<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\ProductAttachment;
use App\Http\Requests\Product\StoreProductAttachmentRequest;
use App\Http\Requests\Product\UpdateProductAttachmentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
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
        $product = Request::input('id');
        $search = Request::input('search');
        return [
            "attachment" => ProductAttachment::with('user')->latest()->where('product_id', $product)->when(Request::input('search'), function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })->paginate()->withQueryString(),
            "filters" => $search
        ];
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
            'product_id' => $request->id,
            'title' => $request->title,
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
        Storage::delete("public/" . $productAttachment["attachment"]);
        $productAttachment->delete();

        return Redirect::back();
    }
}
