<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\ProductModel;
use App\Http\Requests\Product\StoreProductModelRequest;
use App\Http\Requests\Product\UpdateProductModelRequest;
use Illuminate\Support\Facades\Redirect;

class ProductModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
     * @param  \App\Http\Requests\StoreProductModelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductModelRequest $request)
    {
        ProductModel::create([
            'name' => $request->name,
            'product_collection_id' => $request->product_collection_id,
            'user_id' => auth()->user()->id,
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function show(ProductModel $productModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductModel $productModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductModelRequest  $request
     * @param  \App\Models\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductModelRequest $request, ProductModel $productModel)
    {
        $productModel->name = $request->name;
        $productModel->save();
        return Redirect::route('product-collection.show', $productModel->product_collection_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductModel $productModel)
    {
        //
    }
}
