<?php

namespace App\Http\Controllers;

use App\Models\ProductMaterial;
use App\Http\Requests\StoreProductMaterialRequest;
use App\Http\Requests\UpdateProductMaterialRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProductMaterialController extends Controller
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
     * @param  \App\Http\Requests\StoreProductMaterialRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductMaterialRequest $request)
    {
        ProductMaterial::create([
            'name' => $request->nameProductMaterial,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductMaterial  $productMaterial
     * @return \Illuminate\Http\Response
     */
    public function show(ProductMaterial $productMaterial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductMaterial  $productMaterial
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductMaterial $productMaterial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductMaterialRequest  $request
     * @param  \App\Models\ProductMaterial  $productMaterial
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductMaterialRequest $request, ProductMaterial $productMaterial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductMaterial  $productMaterial
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductMaterial $productMaterial)
    {
        //
    }
}
