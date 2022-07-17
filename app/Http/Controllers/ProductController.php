<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\ProductColor;
use App\Models\ProductCountry;
use App\Models\ProductMaterial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Product', [
            "ProductCategory" => ProductCategory::all(),
            "ProductBrand" => ProductBrand::all(),
            "ProductColor" => ProductColor::all(),
            "ProductMaterial" => ProductMaterial::all(),
            "ProductCountry" => ProductCountry::all(),
            "product" => Product::all(),
        ]);
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
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $image_path = '';
        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('image/product', 'public');
        } else {
            $image_path = 'no_image.png';
        }

        Product::create([
            'category' => $request->category,
            'type' => $request->type,
            'brand' => $request->brand,
            'collection' => $request->collection,
            'model' => $request->model,
            'name' => $request->name,
            'color' => $request->color,
            'material' => $request->material,
            'description' => $request->description,
            'sku' => $request->sku,
            'country' => $request->country,
            'image' => $image_path,
            'user' => Auth::id(),
        ]);

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
