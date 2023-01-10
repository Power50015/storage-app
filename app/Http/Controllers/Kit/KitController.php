<?php

namespace App\Http\Controllers\Kit;

use App\Http\Controllers\Controller;
use App\Models\Kit\Kit;
use App\Http\Requests\Kit\StoreKitRequest;
use App\Http\Requests\Kit\UpdateKitRequest;
use App\Models\IncomingInvoice\IncomingInvoiceKit;
use App\Models\IncomingInvoice\ReturnedIncomingInvoiceKit;
use App\Models\Kit\KitOperation;
use App\Models\OutgoingInvoice\OutgoingInvoiceKit;
use App\Models\OutgoingInvoice\ReturnedOutgoingInvoiceKit;
use App\Models\Product\ProductBrand;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductCollection;
use App\Models\Product\ProductColor;
use App\Models\Product\ProductCountry;
use App\Models\Product\ProductMaterial;
use App\Models\Product\ProductModel;
use App\Models\Product\ProductType;
use Illuminate\Support\Facades\Request;
use App\Models\Transfer\TransferKit;
use App\Models\Warehouse\KitStock;
use App\Models\Warehouse\Warehouse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class KitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Kit/Index', [
            "kitCount" => Kit::count(),
            "kitCountWithNoStock" => Kit::where('stock', "<=", 0)->count(),
            "kits" =>  Kit::with(
                'product',
                'product.product_country',
                'product.product_material',
                'product.product_color',
                'product.product_model',
                'product.product_collection',
                'product.product_brand',
                'product.product_type',
                'product.product_category',
                'product_country',
                'product_material',
                'product_color',
                'product_model',
                'product_collection',
                'product_brand',
                'product_type',
                'product_category'
            )->when(Request::input('search'), function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereRelation('product.product_category', 'name', 'like', "%{$search}%")
                    ->orWhereRelation('product.product_type', 'name', 'like', "%{$search}%")
                    ->orWhereRelation('product.product_brand', 'name', 'like', "%{$search}%")
                    ->orWhereRelation('product.product_collection', 'name', 'like', "%{$search}%")
                    ->orWhereRelation('product.product_model', 'name', 'like', "%{$search}%")
                    ->orWhereRelation('product.product_color', 'name', 'like', "%{$search}%")
                    ->orWhereRelation('product.product_material', 'name', 'like', "%{$search}%")
                    ->orWhereRelation('product.product_country', 'name', 'like', "%{$search}%")
                    ->orWhere('product_category', 'name', 'like', "%{$search}%")
                    ->orWhere('product_type', 'name', 'like', "%{$search}%")
                    ->orWhere('product_brand', 'name', 'like', "%{$search}%")
                    ->orWhere('product_collection', 'name', 'like', "%{$search}%")
                    ->orWhere('product_model', 'name', 'like', "%{$search}%")
                    ->orWhere('product_color', 'name', 'like', "%{$search}%")
                    ->orWhere('product_material', 'name', 'like', "%{$search}%")
                    ->orWhere('product_country', 'name', 'like', "%{$search}%");
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
        return Inertia::render('Kit/Create', [
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
     * @param  \App\Http\Requests\StoreKitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKitRequest $request)
    {
        $kit = Kit::create(
            [
                'title' => $request->title,
                'description' => $request->description,
                'product_category_id' => $request->product_category_id,
                'product_type_id' => $request->product_type_id,
                'product_brand_id' => $request->product_brand_id,
                'product_collection_id' => $request->product_collection_id,
                'product_model_id' => $request->product_model_id,
                'product_color_id' => $request->product_color_id,
                'product_material_id' => $request->product_material_id,
                'product_country_id' => $request->product_country_id,
                'product_id' => $request->product_id,
                'user_id' => auth()->user()->id,
                'image' => $request->hasFile('image') ? $request->file('image')->store('image/kit', 'public') : 'no_image.png'
            ]
        );
        return Redirect::route('kit.show', $kit->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function show(Kit $kit)
    {
        return Inertia::render('Kit/Show', [
            "kit" => Kit::with([
                'product',
                'product.product_country',
                'product.product_material',
                'product.product_color',
                'product.product_model',
                'product.product_collection',
                'product.product_brand',
                'product.product_type',
                'product.product_category',
                'product_country',
                'product_material',
                'product_color',
                'product_model',
                'product_collection',
                'product_brand',
                'product_type',
                'product_category'
            ])->where('id', $kit->id)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function edit(Kit $kit)
    {
        return Inertia::render('Kit/Create', [
            "kit" => Kit::where('id', $kit->id)->get(),
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
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKitRequest  $request
     * @param  \App\Models\Kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKitRequest $request, Kit $kit)
    {
        $kit->title = $request->title;
        if ($request->hasFile('image')) {
            Storage::delete("public/" . $request->old_image);
            $kit->image = $request->file('image')->store('image/kit', 'public');
        }
        $kit->description = $request->description;
        $kit->product_id = $request->product_id;
        $kit->save();
        return Redirect::route('kit.show', $kit->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kit $kit)
    {
        //
    }
    /**
     * Get All Action of the Kit
     */
    public function actionData()
    {

        $kit = Request::input('kit');

        $action = Request::input('action');

        // Get Actions
        $actionData = collect([]);
        //  Stock
        if ($action == "Stock" || $action == "all") {
            $KitStock = KitStock::with(['user', 'warehouse_stock', 'warehouse_stock.warehouse'])->where('kit_id', $kit)->get();
            foreach ($KitStock as $key => $value) {
                $KitStock[$key]["dataType"] = "Stock";
                $actionData->push($KitStock[$key]);
            }
        }
        if ($action == "IncomingInvoice" || $action == "all") {
            //  Incoming Invoice
            $IncomingInvoiceKit = IncomingInvoiceKit::with(['user', 'incoming_invoice', 'incoming_invoice.people', 'incoming_invoice.warehouse'])->where('kit_id', $kit)->get();
            foreach ($IncomingInvoiceKit as $key => $value) {
                $IncomingInvoiceKit[$key]["dataType"] = "IncomingInvoice";
                $actionData->push($IncomingInvoiceKit[$key]);
            }
        }
        //  Returned Incoming Invoice
        if ($action == "ReturnedIncomingInvoice" || $action == "all") {
            $ReturnedIncomingInvoiceKit = ReturnedIncomingInvoiceKit::with(['user', 'incoming_invoice', 'incoming_invoice.people', 'incoming_invoice.warehouse'])->where('kit_id', $kit)->get();
            foreach ($ReturnedIncomingInvoiceKit as $key => $value) {
                $ReturnedIncomingInvoiceKit[$key]["dataType"] = "ReturnedIncomingInvoice";
                $actionData->push($ReturnedIncomingInvoiceKit[$key]);
            }
        }
        //  Transfer
        if ($action == "Transfer" || $action == "all") {
            $TransferKit = TransferKit::with(['user', 'transfer', 'transfer.warehouse_from', 'transfer.warehouse_to', 'transfer.driver'])->where('kit_id', $kit)->get();
            foreach ($TransferKit as $key => $value) {
                $TransferKit[$key]["dataType"] = "Transfer";
                $actionData->push($TransferKit[$key]);
            }
        }
        //  Outgoing Invoice
        if ($action == "OutgoingInvoice" || $action == "all") {

            $OutgoingInvoiceKit = OutgoingInvoiceKit::with('user', 'outgoing_invoice', 'outgoing_invoice.people', 'outgoing_invoice.warehouse')->where('kit_id', $kit)->get();
            foreach ($OutgoingInvoiceKit as $key => $value) {
                $OutgoingInvoiceKit[$key]["dataType"] = "OutgoingInvoice";

                $actionData->push($OutgoingInvoiceKit[$key]);
            }
        }
        //  Returned Outgoing Invoice
        if ($action == "ReturnedOutgoingInvoice" || $action == "all") {

            $ReturnedOutgoingInvoiceKit = ReturnedOutgoingInvoiceKit::with('user', 'outgoing_invoice', 'outgoing_invoice.people', 'outgoing_invoice.warehouse')->where('kit_id', $kit)->get();
            foreach ($ReturnedOutgoingInvoiceKit as $key => $value) {
                $ReturnedOutgoingInvoiceKit[$key]["dataType"] = "ReturnedOutgoingInvoice";
                $actionData->push($ReturnedOutgoingInvoiceKit[$key]);
            }
        }
        //  Oprtion
        if ($action == "KitOperation" || $action == "all") {

            $KitOperation = KitOperation::with('user', 'warehouse')->where('kit_id', $kit)->get();
            foreach ($KitOperation as $key => $value) {
                $KitOperation[$key]["dataType"] = "KitOperation";
                $actionData->push($KitOperation[$key]);
            }
        }

        $actionData = $actionData->sortByDesc('date')->paginate();

        return $actionData;
    }
    /**
     * Get All Wearehouse Kit Stock Data
     */
    public function stockData()
    {
        $kit = Request::input('kit');
        $search = Request::input('search');
        $warehouses = $search ? Warehouse::where('name', 'like',  "%{$search}%")->get() : Warehouse::all();

        $warehousesData = collect([]);

        //  where warehouse is
        foreach ($warehouses as $key => $value) {
            $warehouse = $warehouses[$key]['id'];
            $quantity = 0;
            // Add Stock
            $quantity += KitStock::with('warehouse_stock')->where('kit_id', $kit)->whereRelation('warehouse_stock', 'warehouse_id', $warehouse)->sum('quantity');
            // Add Incoming Invoice
            $quantity += IncomingInvoiceKit::with('incoming_invoice')->where('kit_id', $kit)->whereRelation('incoming_invoice', 'warehouse_id', $warehouse)->sum('quantity');
            // subtract Returned Incoming Invoice
            $quantity -= ReturnedIncomingInvoiceKit::with('incoming_invoice')->where('kit_id', $kit)->whereRelation('incoming_invoice', 'warehouse_id', $warehouse)->sum('quantity');
            // Transfer to
            $quantity += TransferKit::with('transfer')->where('kit_id', $kit)->whereRelation('transfer', 'warehouse_to_id', $warehouse)->sum('quantity');
            // Transfer From
            $quantity -= TransferKit::with('transfer')->where('kit_id', $kit)->whereRelation('transfer', 'warehouse_from_id', $warehouse)->sum('quantity');
            // subtract Outgoing Invoice
            $quantity = $quantity - OutgoingInvoiceKit::with('outgoing_invoice')->where('kit_id', $kit)->whereRelation('outgoing_invoice', 'warehouse_id', $warehouse)->sum('quantity');
            //Re-add Returned Outgoing Invoice
            $quantity -= ReturnedOutgoingInvoiceKit::with('outgoing_invoice')->where('kit_id', $kit)->whereRelation('outgoing_invoice', 'warehouse_id', $warehouse)->sum('quantity');
            //subtract Oprtion
            $quantity -= KitOperation::where('kit_id', $kit)->where('warehouse_id', $warehouse)->sum('quantity');

            if ($quantity > 0)
                $warehousesData[] = [
                    "warehouse" => $warehouses[$key],
                    "quantity" => $quantity
                ];
        }
        $warehousesData = $warehousesData->sortByDesc('quantity')->paginate();

        return $warehousesData;
    }
    /**
     * Get All Data of the Kit
     */
    public function data()
    {
        if (Request::input('id')) {
            return Kit::with(
                [
                    'product',
                    'product.product_country',
                    'product.product_material',
                    'product.product_color',
                    'product.product_model',
                    'product.product_collection',
                    'product.product_brand',
                    'product.product_type',
                    'product.product_category',
                    'product_country',
                    'product_material',
                    'product_color',
                    'product_model',
                    'product_collection',
                    'product_brand',
                    'product_type',
                    'product_category'
                ]
            )->where('id', Request::input('id'))->get();
        }
        return Kit::query()->with(
            [
                'product',
                'product.product_country',
                'product.product_material',
                'product.product_color',
                'product.product_model',
                'product.product_collection',
                'product.product_brand',
                'product.product_type',
                'product.product_category',
                'product_country',
                'product_material',
                'product_color',
                'product_model',
                'product_collection',
                'product_brand',
                'product_type',
                'product_category'
            ]
        )->when(Request::input('search'), function ($query, $search) {
            $query->where('title', 'like', "%{$search}%");
        })->paginate(10)->withQueryString();
    }
}
