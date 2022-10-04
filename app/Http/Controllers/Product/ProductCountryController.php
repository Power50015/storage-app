<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\ProductCountry;
use App\Http\Requests\Product\StoreProductCountryRequest;
use App\Http\Requests\Product\UpdateProductCountryRequest;
use Illuminate\Support\Facades\Redirect;

class ProductCountryController extends Controller
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
     * @param  \App\Http\Requests\StoreProductCountryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductCountryRequest $request)
    {
        ProductCountry::create([
            'name' => $request->name,
            'user_id' => auth()->user()->id,
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCountry  $productCountry
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCountry $productCountry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCountry  $productCountry
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCountry $productCountry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductCountryRequest  $request
     * @param  \App\Models\ProductCountry  $productCountry
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductCountryRequest $request, ProductCountry $productCountry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCountry  $productCountry
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCountry $productCountry)
    {
        //
    }
}
