<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductType;
use App\Models\Product\ProductBrand;
use App\Models\Product\ProductCollection;
use App\Models\Product\ProductModel;
use App\Models\Product\ProductColor;
use App\Models\Product\ProductMaterial;
use App\Models\Product\ProductCountry;
use Illuminate\Support\Facades\Request;

use App\Models\IncomingInvoiceContent;
use App\Models\OutgoingInvoiceContent;
use App\Models\ProductAttachment;
use App\Models\ProductImage;
use App\Models\ProductNote;
use App\Models\TransferContent;
use App\Models\WarehouseStockContent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
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

        return Inertia::render('Product/Index', [
            "products" => Product::query()->with(
                [
                    'product_category',
                    'product_type',
                    'product_brand',
                    'product_collection',
                    'product_model',
                    'product_color',
                    'product_material',
                    'product_country'
                ]
            )->when(Request::input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('price', $search)
                    ->orWhereRelation('product_category', 'name', 'like', "%{$search}%")
                    ->orWhereRelation('product_type', 'name', 'like', "%{$search}%")
                    ->orWhereRelation('product_brand', 'name', 'like', "%{$search}%")
                    ->orWhereRelation('product_collection', 'name', 'like', "%{$search}%")
                    ->orWhereRelation('product_model', 'name', 'like', "%{$search}%")
                    ->orWhereRelation('product_color', 'name', 'like', "%{$search}%")
                    ->orWhereRelation('product_material', 'name', 'like', "%{$search}%")
                    ->orWhereRelation('product_country', 'name', 'like', "%{$search}%");
            })->paginate(12)->withQueryString(),

            'filters' => Request::only(['search'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Product/Create', [
            "ProductCategory" => ProductCategory::all(),
            "ProductType" => ProductType::all(),
            "ProductBrand" => ProductBrand::all(),
            "ProductCollection" => ProductCollection::all(),
            "ProductModel" => ProductModel::all(),
            "ProductColor" => ProductColor::all(),
            "ProductMaterial" => ProductMaterial::all(),
            "ProductCountry" => ProductCountry::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        Product::create(array_merge(
            $request->all(),
            [
                'user_id' => auth()->user()->id,
                'image' => $request->hasFile('image') ? $request->file('image')->store('image/product', 'public') : 'no_image.png'
            ]
        ));

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
        /*
        $incomeIvoice = IncomingInvoiceContent::with(['incoming_invoice', 'incoming_invoice.people'])->where('product_id', $product->id)->get();
        $outgoingIvoice = OutgoingInvoiceContent::with(['outgoing_invoice', 'outgoing_invoice.people'])->where('product_id', $product->id)->get();
        $stratStock = WarehouseStockContent::with('warehouse_stock')->where('product_id', $product->id)->get();
        $transfer = TransferContent::with(['transfer', 'transfer.warehouse_from', 'transfer.warehouse_to'])->where('product_id', $product->id)->get();
        $stockData = [];

        //incomeIvoice
        for ($i = 0; $i < count($incomeIvoice); $i++) {
            $stockData[$i] = $incomeIvoice[$i];
            $stockData[$i]["type"] = "فاتورة وارده";
        }
        //outgoingIvoice
        for ($i = count($incomeIvoice), $x = 0; $i < (count($incomeIvoice) + count($outgoingIvoice)); $i++, $x++) {
            $stockData[$i] = $outgoingIvoice[$x];
            $stockData[$i]["type"] = "فاتورة صادره";
        }
        //stratStock
        for ($i = count($incomeIvoice) + count($outgoingIvoice), $x = 0; $i < (count($incomeIvoice) + count($outgoingIvoice) + count($stratStock)); $i++, $x++) {
            $stockData[$i] = $stratStock[$x];
            $stockData[$i]["type"] = "مخزون";
        }
        //transfer
        for ($i = (count($incomeIvoice) + count($outgoingIvoice) + count($stratStock)), $x = 0; $i < (count($incomeIvoice) + count($outgoingIvoice) + count($stratStock) + count($transfer)); $i++, $x++) {
            $stockData[$i] = $transfer[$x];
            $stockData[$i]["type"] = "نقله";
        }
        return Inertia::render('Product/ShowProduct', [
            "product" => Product::with(['product_category', 'product_type', 'product_brand', 'product_collection', 'product_model', 'product_color', 'product_material', 'product_country', 'product_notes', 'product_images', 'product_attachments'])->where('id', $product->id)->get(),
            "stockData" => $stockData,
            "incomeIvoice" => $incomeIvoice,
            "outgoingIvoice" => $outgoingIvoice,
            "stratStock" => $stratStock,
            "transfer" => $transfer,
            "note" => ProductNote::where('product_id', $product->id)->get(),
            "attachment" => ProductAttachment::where('product_id', $product->id)->get(),
            "image" => ProductImage::where('product_id', $product->id)->get(),
        ]);*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return Inertia::render('Product/Edit', [
            "ProductCategory" => ProductCategory::all(),
            "ProductBrand" => ProductBrand::all(),
            "ProductColor" => ProductColor::all(),
            "ProductMaterial" => ProductMaterial::all(),
            "ProductCountry" => ProductCountry::all(),
            "Product" => Product::with(['product_category', 'product_type', 'product_brand', 'product_collection', 'product_model', 'product_color', 'product_material', 'product_country', 'product_notes', 'product_images', 'product_attachments'])->where('id', $product->id)->get(),
        ]);
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
        $image_path = '';
        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('image/product', 'public');
        } else {
            Storage::delete("public/" . $request->image);
            $image_path = $request->oldImage;
        }

        $product = DB::table('products')->where('id', $product->id)->update([
            'product_category_id' => $request->category,
            'product_type_id' => $request->type,
            'product_brand_id' => $request->brand,
            'product_collection_id' => $request->collection,
            'product_model_id' => $request->model,
            'name' => $request->name,
            'product_color_id' => $request->color,
            'product_material_id' => $request->material,
            'description' => $request->description,
            'sku' => $request->sku,
            'product_country_id' => $request->country,
            'image' => $image_path,
            'price' => $request->price,
            'user_id' => Auth::id(),
        ]);

        return Redirect::back();
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
    // Get All Products as a row data
    public function data()
    {
        if (Request::input('id')) return Product::with(
            [
                'product_category',
                'product_type',
                'product_brand',
                'product_collection',
                'product_model',
                'product_color',
                'product_material',
                'product_country'
            ]
        )->where('id', Request::input('id'))->get();
        return Product::query()->with(
            [
                'product_category',
                'product_type',
                'product_brand',
                'product_collection',
                'product_model',
                'product_color',
                'product_material',
                'product_country'
            ]
        )->when(Request::input('search'), function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('sku', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('price', $search)
                ->orWhereRelation('product_category', 'name', 'like', "%{$search}%")
                ->orWhereRelation('product_type', 'name', 'like', "%{$search}%")
                ->orWhereRelation('product_brand', 'name', 'like', "%{$search}%")
                ->orWhereRelation('product_collection', 'name', 'like', "%{$search}%")
                ->orWhereRelation('product_model', 'name', 'like', "%{$search}%")
                ->orWhereRelation('product_color', 'name', 'like', "%{$search}%")
                ->orWhereRelation('product_material', 'name', 'like', "%{$search}%")
                ->orWhereRelation('product_country', 'name', 'like', "%{$search}%");
        })->paginate(10)->withQueryString();
    }
}
