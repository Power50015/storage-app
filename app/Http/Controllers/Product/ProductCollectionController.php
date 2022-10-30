<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\ProductCollection;
use App\Http\Requests\Product\StoreProductCollectionRequest;
use App\Http\Requests\Product\UpdateProductCollectionRequest;
use App\Models\Product\ProductBrand;
use App\Models\Product\ProductModel;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class ProductCollectionController extends Controller
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
     * @param  \App\Http\Requests\StoreProductCollectionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductCollectionRequest $request)
    {
        ProductCollection::create([
            'name' => $request->name,
            'product_brand_id' => $request->product_brand_id,
            'user_id' => auth()->user()->id,
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
        return Inertia::render('Product/Collection/Show', [
            "product_brand" => ProductBrand::with('user', 'product_country')->where('id', $productCollection->product_brand_id)->get(),
            "product_collection" => ProductCollection::with('user')->where('id', $productCollection->id)->get(),
            "product_model_count" => ProductModel::where('product_collection_id', $productCollection->id)->count(),
            "product_model" => ProductModel::query()->with('user')->when(Request::input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })->where('product_collection_id', $productCollection->id)->paginate()->withQueryString(),
            'filters' => Request::only([
                'search',
            ])
        ]);
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
        $productCollection->name = $request->name;
        $productCollection->save();
        return Redirect::route('product-collection.show', $productCollection->id);
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
