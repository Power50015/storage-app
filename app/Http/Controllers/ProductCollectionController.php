<?php

namespace App\Http\Controllers;

use App\Models\ProductCollection;
use App\Http\Requests\StoreProductCollectionRequest;
use App\Http\Requests\UpdateProductCollectionRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProductCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return ProductCollection::where('product_brand', $id)->get();
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
     * @param  \App\Http\Requests\StoreProductCollectionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductCollectionRequest $request)
    {
        ProductCollection::create([
            'name' => $request->nameProductCollection,
            'product_brand' => $request->productBrand,
            'user' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCollection  $productCollection
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCollection $productCollection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCollection  $productCollection
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCollection $productCollection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductCollectionRequest  $request
     * @param  \App\Models\ProductCollection  $productCollection
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductCollectionRequest $request, ProductCollection $productCollection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCollection  $productCollection
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCollection $productCollection)
    {
        //
    }
}
