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
use App\Models\IncomingInvoice\IncomingInvoiceContent;
use App\Models\IncomingInvoice\ReturnedIncomingInvoice;
use App\Models\Kit\Kit;
use App\Models\OutgoingInvoice\OutgoingInvoiceContent;
use App\Models\OutgoingInvoice\ReturnedOutgoingInvoice;
use App\Models\Product\DestructibleGoodsAction;
use App\Models\ReturnedIncomingInvoice\ReturnedIncomingInvoiceContent;
use App\Models\ReturnedOutgoingInvoice\ReturnedOutgoingInvoiceContent;
use App\Models\Transfer\TransferContent;
use App\Models\Warehouse\Warehouse;
use App\Models\Warehouse\WarehouseStockContent;
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

        $product_count = Product::count();

        return Inertia::render('Product/Index', [
            "product_category_count" => ProductCategory::count(),
            "product_type_count" => ProductType::count(),
            "product_brand_count" => ProductBrand::count(),
            "product_brand" => ProductBrand::all(),
            "product_count" => $product_count,
            "product_category" => ProductCategory::all(),
            "product_type" => ProductType::all(),
            "product_collection" => ProductCollection::all(),
            "product_model" => ProductModel::all(),
            "product_color" => ProductColor::all(),
            "product_material" => ProductMaterial::all(),
            "product_country" => ProductCountry::all(),
            "product_stock_count" => Product::where('stock', ">", 0)->count(),
            "destructible" => Product::where('destructible', ">", 0)->count(),
            "products" => Product::query()->with(
                [
                    'product_category',
                    'product_type',
                    'product_brand',
                    'product_collection',
                    'product_model',
                    'product_color',
                    'product_material',
                    'product_country',
                ]
            )->when(Request::input('product_category_id'), function ($query, $product_category_id) {
                $query->where('product_category_id', $product_category_id);
            })->when(Request::input('product_type_id'), function ($query, $product_type_id) {
                $query->where('product_type_id', $product_type_id);
            })->when(Request::input('product_brand_id'), function ($query, $product_brand_id) {
                $query->where('product_brand_id', $product_brand_id);
            })->when(Request::input('product_collection_id'), function ($query, $product_collection_id) {
                $query->where('product_collection_id', $product_collection_id);
            })->when(Request::input('product_model_id'), function ($query, $product_model_id) {
                $query->where('product_model_id', $product_model_id);
            })->when(Request::input('product_color_id'), function ($query, $product_color_id) {
                $query->where('product_color_id', $product_color_id);
            })->when(Request::input('product_material_id'), function ($query, $product_material_id) {
                $query->where('product_material_id', $product_material_id);
            })->when(Request::input('product_country_id'), function ($query, $product_country_id) {
                $query->where('product_country_id', $product_country_id);
            })->when(Request::input('price_from'), function ($query, $price_from) {
                $query->where('price', '>=', $price_from);
            })->when(Request::input('price_to'), function ($query, $price_to) {
                $query->where('price', '<=', $price_to);
            })->when(Request::input('search'), function ($query, $search) {
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
            })->when(Request::input('product_stock'), function ($query, $product_stock) {
                $product_stock == "1" ?
                    $query->where('stock', '<=', 0) :
                    $query->where('stock', '>', 0);
            })->when(Request::input('destructible_goods'), function ($query, $destructible_goods) {
                $destructible_goods == "1" ?
                    $query->where('destructible', '<=', 0) :
                    $query->where('destructible', '>', 0);
            })->paginate(12)->withQueryString(),
            'filters' => Request::only([
                'search',
                'product_category_id',
                'product_type_id',
                'product_brand_id',
                'product_collection_id',
                'product_model_id',
                'product_color_id',
                'product_material_id',
                'product_country_id',
                'price_from',
                'price_to',
                'product_stock',
                'destructible_goods'
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
        $product = Product::create(
            [
                'name' => $request->name,
                'description' => $request->description,
                'sku' => $request->sku,
                'product_category_id' => $request->product_category_id,
                'product_type_id' => $request->product_type_id,
                'product_brand_id' => $request->product_brand_id,
                'product_collection_id' => $request->product_collection_id,
                'product_model_id' => $request->product_model_id,
                'product_color_id' => $request->product_color_id,
                'product_material_id' => $request->product_material_id,
                'product_country_id' => $request->product_country_id,
                'price' => $request->price,
                'stock' => 0,
                'destructible' => 0,
                'user_id' => auth()->user()->id,
                'image' => $request->hasFile('image') ? $request->file('image')->store('image/product', 'public') : 'no_image.png'
            ]
        );

        return Redirect::route('product.show', $product->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return Inertia::render('Product/Show', [
            "product" => Product::with(
                [
                    'product_category',
                    'product_type',
                    'product_brand',
                    'product_collection',
                    'product_model',
                    'product_color',
                    'product_material',
                    'product_country',
                    'product_brand.product_country'
                ]
            )->where('id', $product->id)->get(),
            "total_sales" => OutgoingInvoiceContent::Where("product_id", $product->id)->sum("quantity") -  ReturnedOutgoingInvoiceContent::Where("product_id", $product->id)->sum("quantity")
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
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
            "product" => Product::with(
                [
                    'product_category',
                    'product_type',
                    'product_brand',
                    'product_collection',
                    'product_model',
                    'product_color',
                    'product_material',
                    'product_country',
                ]
            )->where('id', $product->id)->get(),
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

        $product->product_category_id = $request->product_category_id;
        $product->product_type_id = $request->product_type_id;
        $product->product_brand_id = $request->product_brand_id;
        $product->product_collection_id = $request->product_collection_id;
        $product->product_model_id = $request->product_model_id;
        $product->name = $request->name;
        $product->product_color_id = $request->product_color_id;
        $product->product_material_id = $request->product_material_id;
        $product->description = $request->description;
        $product->sku = $request->sku;
        $product->product_country_id = $request->product_country_id;
        $product->price = $request->price;

        if ($request->hasFile('image')) {
            Storage::delete("public/" . $request->old_image);
            $product->image = $request->file('image')->store('image/product', 'public');
        }

        $product->save();
        return Redirect::route('product.show', $product->id);
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
        if (Request::input('id')) {
            return Product::with(
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
        }
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

    /**
     * Get All Action of the product
     */
    public function actionData()
    {

        $product = Request::input('product');

        $action = Request::input('action');

        // Get Actions
        $actionData = collect([]);

        //  Stock
        if ($action == "Stock" || $action == "all") {
            $WarehouseStockContent = WarehouseStockContent::with(['user', 'warehouse_stock', 'warehouse'])->where('product_id', $product)->get();
            foreach ($WarehouseStockContent as $key => $value) {
                $WarehouseStockContent[$key]["dataType"] = "Stock";
                $actionData->push($WarehouseStockContent[$key]);
            }
        }

        //  Incoming Invoice
        if ($action == "IncomingInvoice" || $action == "all") {
            $IncomingInvoiceContent = IncomingInvoiceContent::with(['user', 'incoming_invoice', 'people', 'warehouse'])->where('product_id', $product)->get();
            foreach ($IncomingInvoiceContent as $key => $value) {
                $IncomingInvoiceContent[$key]["dataType"] = "IncomingInvoice";
                $actionData->push($IncomingInvoiceContent[$key]);
            }
        }

        //  Returned Incoming Invoice
        if ($action == "ReturnedIncomingInvoice" || $action == "all") {
            $ReturnedIncomingInvoice = ReturnedIncomingInvoiceContent::with(['user', 'returned_incoming_invoice', 'people', 'warehouse'])->where('product_id', $product)->get();
            foreach ($ReturnedIncomingInvoice as $key => $value) {
                $ReturnedIncomingInvoice[$key]["dataType"] = "ReturnedIncomingInvoice";
                $actionData->push($ReturnedIncomingInvoice[$key]);
            }
        }

        //  Transfer
        if ($action == "Transfer" || $action == "all") {
            $TransferContent = TransferContent::with(['user', 'transfer', 'warehouse_from', 'warehouse_to', 'transfer.driver'])->where('product_id', $product)->get();
            foreach ($TransferContent as $key => $value) {
                $TransferContent[$key]["dataType"] = "Transfer";
                $actionData->push($TransferContent[$key]);
            }
        }

        //  Outgoing Invoice
        if ($action == "OutgoingInvoice" || $action == "all") {
            $OutgoingInvoiceContent = OutgoingInvoiceContent::with('user', 'outgoing_invoice', 'people', 'warehouse')->where('product_id', $product)->get();
            foreach ($OutgoingInvoiceContent as $key => $value) {
                $OutgoingInvoiceContent[$key]["dataType"] = "OutgoingInvoice";

                $actionData->push($OutgoingInvoiceContent[$key]);
            }
        }

        //  Returned Outgoing Invoice
        if ($action == "ReturnedOutgoingInvoice" || $action == "all") {
            $ReturnedOutgoingInvoice = ReturnedOutgoingInvoiceContent::with('user', 'returned_outgoing_invoice', 'people', 'warehouse')->where('product_id', $product)->get();
            foreach ($ReturnedOutgoingInvoice as $key => $value) {
                $ReturnedOutgoingInvoice[$key]["dataType"] = "ReturnedOutgoingInvoice";
                $actionData->push($ReturnedOutgoingInvoice[$key]);
            }
        }

        //  Oprtion
        if ($action == "Oprtion" || $action == "all") {
            $DestructibleGoodsAction = DestructibleGoodsAction::with('user', 'destructible_goods',  'destructible_goods.warehouse')->whereRelation('destructible_goods', 'product_id', $product)->get();
            foreach ($DestructibleGoodsAction as $key => $value) {
                $DestructibleGoodsAction[$key]["dataType"] = "DestructibleGoods";
                $actionData->push($DestructibleGoodsAction[$key]);
            }
        }

        $actionData = $actionData->sortByDesc('date')->paginate();

        return $actionData;
    }
    /**
     * Get All Wearehouse Product Stock Data
     */
    public function stockData()
    {
        $product = Request::input('product');
        $search = Request::input('search');
        // $warehouses = $search ? Warehouse::where('name', 'like',  "%{$search}%")->get() : Warehouse::all();

        $warehouses = Warehouse::query()->when(Request::input('search'), function ($query, $search) {
            $query->where('name', 'like', "%{$search}%");
        })->get();

        // return $warehouses;

        $warehousesData = collect([]);

        //  where warehouse is
        foreach ($warehouses as $key => $value) {
            $warehouse = $warehouses[$key]['id'];
            $quantity = 0;
            // Add Stock
            $quantity += WarehouseStockContent::with('warehouse_stock')->where('product_id', $product)->where('warehouse_id', $warehouse)->sum('quantity');
            // Add Incoming Invoice
            $quantity += IncomingInvoiceContent::where('product_id', $product)->where('warehouse_id', $warehouse)->sum('quantity');
            // subtract Returned Incoming Invoice
            $quantity -= ReturnedIncomingInvoiceContent::where('product_id', $product)->where('warehouse_id', $warehouse)->sum('quantity');
            // Transfer to
            $quantity += TransferContent::with('transfer')->where('product_id', $product)->where('warehouse_to_id', $warehouse)->sum('quantity');
            // Transfer From
            $quantity -= TransferContent::with('transfer')->where('product_id', $product)->where('warehouse_from_id', $warehouse)->sum('quantity');
            // subtract Outgoing Invoice
            $quantity -= OutgoingInvoiceContent::where('product_id', $product)->where('warehouse_id', $warehouse)->sum('quantity');
            //Re-add Returned Outgoing Invoice
            $quantity += ReturnedOutgoingInvoiceContent::where('product_id', $product)->where('warehouse_id', $warehouse)->sum('quantity');

            // DestructibleGoodsAction
            $DestructibleGoodsAction = DestructibleGoodsAction::where('action', 0)->whereRelation('destructible_goods', 'warehouse_id', $warehouse)->whereRelation('destructible_goods', 'product_id', $product)->count();
            $DestructibleGoodsAction -= DestructibleGoodsAction::where('action', 2)->whereRelation('destructible_goods', 'warehouse_id', $warehouse)->whereRelation('destructible_goods', 'product_id', $product)->count();
            $quantity -= $DestructibleGoodsAction;
            $DestructibleGoodsAction -= DestructibleGoodsAction::where('action', 1)->whereRelation('destructible_goods', 'warehouse_id', $warehouse)->whereRelation('destructible_goods', 'product_id', $product)->count();

            if ($quantity > 0)
                $warehousesData[] = [
                    "warehouse" => $warehouses[$key],
                    "quantity" => $quantity,
                    "destructibleGoods" => $DestructibleGoodsAction
                ];
        }
        $warehousesData = $warehousesData->sortByDesc('quantity')->paginate();

        return $warehousesData;
    }
    /**
     * Get All Kits Of Product
     */
    public function kits()
    {
        $product = Request::input('product');
        if ($product)
            return [
                "kit" => Kit::query()->where('product_id', $product)->when(Request::input('search'), function ($query, $search) {
                    $query->where('title', 'like', "%{$search}%");
                })->with('user')->paginate()->withQueryString(),
                'filters' => Request::only(['search'])
            ];
    }
}
