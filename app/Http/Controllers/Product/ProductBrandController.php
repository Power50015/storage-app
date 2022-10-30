<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\ProductBrand;
use App\Http\Requests\Product\StoreProductBrandRequest;
use App\Http\Requests\Product\UpdateProductBrandRequest;
use App\Models\Product\ProductCollection;
use App\Models\Product\ProductCountry;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class ProductBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Product/Brand/Index', [
            "ProductCountry" => ProductCountry::all(),
            "product_brand_count" => ProductBrand::count(),
            "product_brand" => ProductBrand::query()->with('user', 'product_country')->when(Request::input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")->orWhereRelation('product_country', 'name', 'like', "%{$search}%");
            })->paginate()->withQueryString(),
            'filters' => Request::only([
                'search',
            ])
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
     * @param  \App\Http\Requests\StoreProductBrandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductBrandRequest $request)
    {

        ProductBrand::create([
            'name' => $request->name,
            'user_id' => auth()->user()->id,
            'logo' => $request->hasFile('image') ?
                $request->file('image')->store('image/brand', 'public') : 'no_image.png',
            'product_country_id' => $request->product_country_id
        ]);

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductBrand  $productBrand
     * @return \Illuminate\Http\Response
     */
    public function show(ProductBrand $productBrand)
    {
        return Inertia::render('Product/Brand/Show', [
            "ProductCountry" => ProductCountry::all(),
            "product_brand" => ProductBrand::with('user', 'product_country')->where('id', $productBrand->id)->get(),
            "product_collections_count" => ProductCollection::where('product_brand_id', $productBrand->id)->count(),
            "product_collections" => ProductCollection::query()->with('user')->when(Request::input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })->where('product_brand_id', $productBrand->id)->paginate()->withQueryString(),
            'filters' => Request::only([
                'search',
            ])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductBrand  $productBrand
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductBrand $productBrand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductBrandRequest  $request
     * @param  \App\Models\ProductBrand  $productBrand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductBrandRequest $request, ProductBrand $productBrand)
    {
        $productBrand->name = $request->name;
        $productBrand->logo = $request->hasFile('image') ?
            $request->file('image')->store('image/brand', 'public') : 'no_image.png';

        $productBrand->product_country_id = $request->product_country_id;
        $productBrand->save();
        return Redirect::route('product-brand.show', $productBrand->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductBrand  $productBrand
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductBrand $productBrand)
    {
        //
    }

    // Get All Products as a row data
    public function data()
    {
        if (Request::input('id')) {
            return ProductBrand::with(
                [
                    'product_country'
                ]
            )->where('id', Request::input('id'))->get();
        }
        return ProductBrand::query()->with(
            [
                'product_country'
            ]
        )->when(Request::input('search'), function ($query, $search) {
            $query->where('name', 'like', "%{$search}%");
        })->paginate(10)->withQueryString();
    }
}
