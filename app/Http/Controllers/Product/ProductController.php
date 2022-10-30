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
                $ids = [];
                $sql = Product::get('id')->where('total_number_of_product', '<=', 0);
                foreach ($sql as $key => $value) {
                    $ids[] = ($sql[$key]['id']);
                }
                $product_stock == "1" ?
                    $query->whereIn('id', $ids) :
                    $query->whereNotIn('id', $ids);
            })->when(Request::input('destructible_goods'), function ($query, $destructible_goods) {
                $ids = [];
                $sql = Product::get('id')->where('destructible_goods', '<=', 0);
                foreach ($sql as $key => $value) {
                    $ids[] = ($sql[$key]['id']);
                }
                $destructible_goods == "1" ?
                    $query->whereIn('id', $ids) :
                    $query->whereNotIn('id', $ids);
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
            $WarehouseStockContent = WarehouseStockContent::with(['user', 'warehouse_stock', 'warehouse_stock.warehouse'])->where('product_id', $product)->get();
            foreach ($WarehouseStockContent as $key => $value) {
                $WarehouseStockContent[$key]["dataType"] = "Stock";
                $WarehouseStockContent[$key]["date"] = $WarehouseStockContent[$key]["warehouse_stock"]["date"];
                $actionData->push($WarehouseStockContent[$key]);
            }
        }
        if ($action == "IncomingInvoice" || $action == "all") {
            //  Incoming Invoice
            $IncomingInvoiceContent = IncomingInvoiceContent::with(['user', 'incoming_invoice', 'incoming_invoice.people', 'incoming_invoice.warehouse'])->where('product_id', $product)->get();
            foreach ($IncomingInvoiceContent as $key => $value) {
                $IncomingInvoiceContent[$key]["dataType"] = "IncomingInvoice";
                $IncomingInvoiceContent[$key]["date"] = $IncomingInvoiceContent[$key]["incoming_invoice"]["date"];
                $actionData->push($IncomingInvoiceContent[$key]);
            }
        }
        //  Returned Incoming Invoice
        if ($action == "ReturnedIncomingInvoice" || $action == "all") {
            $ReturnedIncomingInvoice = ReturnedIncomingInvoice::with(['user', 'incoming_invoice', 'incoming_invoice.people', 'incoming_invoice.warehouse'])->where('product_id', $product)->get();
            foreach ($ReturnedIncomingInvoice as $key => $value) {
                $ReturnedIncomingInvoice[$key]["dataType"] = "ReturnedIncomingInvoice";
                $actionData->push($ReturnedIncomingInvoice[$key]);
            }
        }
        //  Transfer
        if ($action == "Transfer" || $action == "all") {
            $TransferContent = TransferContent::with(['user', 'transfer', 'transfer.warehouse_from', 'transfer.warehouse_to', 'transfer.driver'])->where('product_id', $product)->get();
            foreach ($TransferContent as $key => $value) {
                $TransferContent[$key]["dataType"] = "Transfer";
                $TransferContent[$key]["date"] = $TransferContent[$key]["transfer"]["date"];
                $actionData->push($TransferContent[$key]);
            }
        }
        //  Outgoing Invoice
        if ($action == "OutgoingInvoice" || $action == "all") {

            $OutgoingInvoiceContent = OutgoingInvoiceContent::with('user', 'outgoing_invoice', 'outgoing_invoice.people', 'outgoing_invoice.warehouse')->where('product_id', $product)->get();
            foreach ($OutgoingInvoiceContent as $key => $value) {
                $OutgoingInvoiceContent[$key]["dataType"] = "OutgoingInvoice";
                $OutgoingInvoiceContent[$key]["date"] = $OutgoingInvoiceContent[$key]["outgoing_invoice"]["date"];

                $actionData->push($OutgoingInvoiceContent[$key]);
            }
        }
        //  Returned Outgoing Invoice
        if ($action == "ReturnedOutgoingInvoice" || $action == "all") {

            $ReturnedOutgoingInvoice = ReturnedOutgoingInvoice::with('user', 'outgoing_invoice', 'outgoing_invoice.people', 'outgoing_invoice.warehouse')->where('product_id', $product)->get();
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

        $actionData = $actionData->sortByDesc('date')->sortByDesc('created_at')->paginate();

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
            $quantity += WarehouseStockContent::with('warehouse_stock')->where('product_id', $product)->whereRelation('warehouse_stock', 'warehouse_id', $warehouse)->sum('quantity');
            // Add Incoming Invoice
            $quantity += IncomingInvoiceContent::with('incoming_invoice')->where('product_id', $product)->whereRelation('incoming_invoice', 'warehouse_id', $warehouse)->sum('quantity');
            // subtract Returned Incoming Invoice
            $quantity -= ReturnedIncomingInvoice::with('incoming_invoice')->where('product_id', $product)->whereRelation('incoming_invoice', 'warehouse_id', $warehouse)->sum('quantity');
            // Transfer to
            $quantity += TransferContent::with('transfer')->where('product_id', $product)->whereRelation('transfer', 'warehouse_to_id', $warehouse)->sum('quantity');
            // Transfer From
            $quantity -= TransferContent::with('transfer')->where('product_id', $product)->whereRelation('transfer', 'warehouse_from_id', $warehouse)->sum('quantity');
            // subtract Outgoing Invoice
            $quantity = $quantity - OutgoingInvoiceContent::with('outgoing_invoice')->where('product_id', $product)->whereRelation('outgoing_invoice', 'warehouse_id', $warehouse)->sum('quantity');
            //Re-add Returned Outgoing Invoice
            $quantity -= ReturnedOutgoingInvoice::with('outgoing_invoice')->where('product_id', $product)->whereRelation('outgoing_invoice', 'warehouse_id', $warehouse)->sum('quantity');
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
