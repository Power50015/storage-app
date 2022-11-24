<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Requests\Warehouse\StoreWarehouseRequest;
use App\Http\Requests\Warehouse\UpdateWarehouseRequest;
use App\Models\IncomingInvoice\IncomingInvoice;
use App\Models\IncomingInvoice\IncomingInvoiceContent;
use App\Models\IncomingInvoice\IncomingInvoiceKit;
use App\Models\IncomingInvoice\ReturnedIncomingInvoice;
use App\Models\IncomingInvoice\ReturnedIncomingInvoiceKit;
use App\Models\Kit\Kit;
use App\Models\Kit\KitOperation;
use App\Models\OutgoingInvoice\OutgoingInvoice;
use App\Models\OutgoingInvoice\OutgoingInvoiceContent;
use App\Models\OutgoingInvoice\OutgoingInvoiceKit;
use App\Models\OutgoingInvoice\ReturnedOutgoingInvoice;
use App\Models\OutgoingInvoice\ReturnedOutgoingInvoiceKit;
use App\Models\Product\DestructibleGoodsAction;
use App\Models\Product\Product;
use App\Models\Transfer\Transfer;
use App\Models\Transfer\TransferContent;
use App\Models\Transfer\TransferKit;
use App\Models\Warehouse\KitStock;
use App\Models\Warehouse\Warehouse;
use App\Models\Warehouse\WarehouseStock;
use App\Models\Warehouse\WarehouseStockContent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Warehouse::all();
        return Inertia::render('Warehouse/Index', [
            "warehouses" => Warehouse::query()->when(Request::input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })->with('user')->paginate()->withQueryString(),
            'totalWarehouse' => Warehouse::count(),
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
        return Inertia::render('Warehouse/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWarehouseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWarehouseRequest $request)
    {
        $warehouse = Warehouse::create([
            'name' => $request->name,
            'address' => $request->address,
            'user_id' => Auth::id()
        ]);
        return Redirect::route('Warehouse.show', $warehouse->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $warehouse)
    {
        return Inertia::render('Warehouse/Show', [
            "warehouse" => $warehouse
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse $warehouse)
    {
        return Inertia::render('Warehouse/Create', [
            "warehouse" => $warehouse
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWarehouseRequest  $request
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWarehouseRequest $request, Warehouse $warehouse)
    {
        $warehouse->name = $request->name;
        $warehouse->address = $request->address;
        $warehouse->save();
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse $warehouse)
    {
        //
    }

    public function stockData()
    {
        $warehouse = Request::input('warehouse');
        $action = Request::input('action');
        $actionData = collect([]);
        if ($action == "Product" || $action == null) {
            $products = Product::with(
                'product_category',
                'product_type',
                'product_brand',
                'product_collection',
                'product_model',
                'product_color',
                'product_material',
                'product_country',
                'product_brand.product_country'
            )->get();

            foreach ($products as $key => $value) {
                $quantity = 0;
                $quantity += WarehouseStockContent::with('warehouse_stock')->where('product_id', $products[$key]['id'])->get()->where('warehouse_stock.warehouse_id', $warehouse)->sum('quantity');
                $quantity += IncomingInvoiceContent::with('incoming_invoice')->where('product_id', $products[$key]['id'])->get()->where('incoming_invoice.warehouse_id', $warehouse)->sum('quantity');
                $quantity += ReturnedOutgoingInvoice::with('outgoing_invoice')->where('product_id', $products[$key]['id'])->get()->where('outgoing_invoice.warehouse_id', $warehouse)->sum('quantity');
                if ($quantity == 0) continue;
                $quantity -= ReturnedIncomingInvoice::with('incoming_invoice')->where('product_id', $products[$key]['id'])->get()->where('incoming_invoice.warehouse_id', $warehouse)->sum('quantity');
                $quantity -= OutgoingInvoiceContent::with('outgoing_invoice')->where('product_id', $products[$key]['id'])->get()->where('outgoing_invoice.warehouse_id', $warehouse)->sum('quantity');
                $quantity -= DestructibleGoodsAction::where('action', 1)->whereRelation('destructible_goods', 'product_id', $products[$key]['id'])->whereRelation('destructible_goods', 'warehouse_id', $warehouse)->count();
                if ($quantity == 0) continue;
                $products[$key]["quantity"] = $quantity;
                $products[$key]["dataType"] = "Product";
                $actionData->push($products[$key]);
            }
        }
        if ($action == "Kit" || $action == null) {
            $kits = Kit::with(
                'product',
                'product.product_country',
                'product.product_material',
                'product.product_color',
                'product.product_model',
                'product.product_collection',
                'product.product_brand',
                'product.product_type',
                'product.product_category'
            )->get();

            foreach ($kits as $key => $value) {
                $quantity = 0;
                $quantity += KitStock::with('warehouse_stock')->where('kit_id', $kits[$key]['id'])->get()->where('warehouse_stock.warehouse_id', $warehouse)->sum('quantity');
                $quantity += IncomingInvoiceKit::with('incoming_invoice')->where('kit_id', $kits[$key]['id'])->get()->where('incoming_invoice.warehouse_id', $warehouse)->sum('quantity');
                $quantity += ReturnedOutgoingInvoiceKit::with('outgoing_invoice')->where('kit_id', $kits[$key]['id'])->get()->where('outgoing_invoice.warehouse_id', $warehouse)->sum('quantity');
                if ($quantity == 0) continue;
                $quantity -= KitOperation::where('kit_id', $kits[$key]['id'])->sum('quantity');
                $quantity -= ReturnedIncomingInvoiceKit::with('incoming_invoice')->where('kit_id', $kits[$key]['id'])->get()->where('incoming_invoice.warehouse_id', $warehouse)->sum('quantity');
                $quantity -= OutgoingInvoiceKit::with('outgoing_invoice')->where('kit_id', $kits[$key]['id'])->get()->where('outgoing_invoice.warehouse_id', $warehouse)->sum('quantity');
                if ($quantity == 0) continue;
                $kits[$key]["quantity"] = $quantity;
                $kits[$key]["dataType"] = "Kit";
                $actionData->push($kits[$key]);
            }
        }

        $actionData = $actionData->sortByDesc('quantity');

        return $actionData->values()->all();
    }
    public function actionData()
    {
        $warehouse = Request::input('warehouse');
        $action = Request::input('action');

        // Get Actions
        $actionData = collect([]);

        if ($action == "Stock" || $action == null) {
            $WarehouseStock = WarehouseStock::with('user')->where('warehouse_id', $warehouse)->get();
            foreach ($WarehouseStock as $key => $value) {
                $WarehouseStock[$key]["dataType"] = "Stock";
                $actionData->push($WarehouseStock[$key]);
            }
        }

        if ($action == "IncomingInvoice" || $action == null) {
            $IncomingInvoiceContent = IncomingInvoice::with('user', 'people', 'cash')->where('warehouse_id', $warehouse)->get();
            foreach ($IncomingInvoiceContent as $key => $value) {
                $IncomingInvoiceContent[$key]["dataType"] = "IncomingInvoice";
                $actionData->push($IncomingInvoiceContent[$key]);
            }
        }

        if ($action == "OutgoingInvoice" || $action == null) {
            $OutgoingInvoiceContent = OutgoingInvoice::with('user', 'people', 'cash')->where('warehouse_id', $warehouse)->get();
            foreach ($OutgoingInvoiceContent as $key => $value) {
                $OutgoingInvoiceContent[$key]["dataType"] = "OutgoingInvoice";
                $actionData->push($OutgoingInvoiceContent[$key]);
            }
        }

        if ($action == "TransferFrom" || $action == null) {
            $TransferFrom = Transfer::with('user', 'driver', 'warehouse_to')->where('warehouse_from_id', $warehouse)->get();
            foreach ($TransferFrom as $key => $value) {
                $TransferFrom[$key]["dataType"] = "TransferFrom";
                $actionData->push($TransferFrom[$key]);
            }
        }
        if ($action == "TransferTo" || $action == null) {
            $TransferTo = Transfer::with('user', 'driver', 'warehouse_from')->where('warehouse_to_id', $warehouse)->get();
            foreach ($TransferTo as $key => $value) {
                $TransferTo[$key]["dataType"] = "TransferTo";
                $actionData->push($TransferTo[$key]);
            }
        }

        if ($action == "DestructibleGoods" || $action == null) {
            $TransferTo = DestructibleGoodsAction::with(
                'user',
                'destructible_goods',
                'destructible_goods.product',
                'destructible_goods.product.product_country',
                'destructible_goods.product.product_material',
                'destructible_goods.product.product_color',
                'destructible_goods.product.product_model',
                'destructible_goods.product.product_collection',
                'destructible_goods.product.product_brand',
                'destructible_goods.product.product_type',
                'destructible_goods.product.product_category'
            )->whereRelation('destructible_goods', 'warehouse_id', $warehouse)->get();
            foreach ($TransferTo as $key => $value) {
                $TransferTo[$key]["dataType"] = "DestructibleGoods";
                $actionData->push($TransferTo[$key]);
            }
        }

        if ($action == "KitOperation" || $action == null) {
            $KitOperation = KitOperation::with(
                'user',
                'kit',
                'kit.product',
                'kit.product.product_country',
                'kit.product.product_material',
                'kit.product.product_color',
                'kit.product.product_model',
                'kit.product.product_collection',
                'kit.product.product_brand',
                'kit.product.product_type',
                'kit.product.product_category'
            )->where('warehouse_id', $warehouse)->get();
            foreach ($KitOperation as $key => $value) {
                $KitOperation[$key]["dataType"] = "KitOperation";
                $actionData->push($KitOperation[$key]);
            }
        }

        $actionData = $actionData->sortByDesc('date')->values();

        return $actionData->paginate();
    }
    public function destructibleGoods()
    {
        $warehouse = Request::input('warehouse');
        $ids = [];
        $data = DestructibleGoodsAction::where('action', '==', 0)->whereRelation('destructible_goods', 'warehouse_id', $warehouse)->get();
        foreach ($data as $key => $value) {
            if (DestructibleGoodsAction::where('destructible_goods_id', $data[$key]['destructible_goods_id'])->count() == 1) {
                $row = DestructibleGoodsAction::where('destructible_goods_id', $data[$key]['destructible_goods_id'])->get('id');
                $ids[] = $row[0]['id'];
            }
        }
        return [
            "DestructibleGoodsAction" => DestructibleGoodsAction::with(
                'destructible_goods',
                'user',
                'destructible_goods.product',
                'destructible_goods.warehouse'
            )->whereIn('id',  $ids)->paginate()
        ];
    }
    public function warehouseActionDetails()
    {
        $warehouse = Request::input('warehouse');
        $action = Request::input('action');

        // Get Actions
        $actionData = collect([]);

        if ($action == "Stock" || $action == null) {
            $WarehouseStockContent = WarehouseStockContent::with(
                'user',
                'warehouse_stock',
                'product',
                'product.product_category',
                'product.product_type',
                'product.product_brand',
                'product.product_collection',
                'product.product_model',
                'product.product_color',
                'product.product_material',
                'product.product_country'
            )->get()->where('warehouse_stock.warehouse_id', $warehouse);
            foreach ($WarehouseStockContent as $key => $value) {
                $WarehouseStockContent[$key]["dataType"] = "Stock";
                $WarehouseStockContent[$key]["date"] = $WarehouseStockContent[$key]["warehouse_stock"]["date"];
                $actionData->push($WarehouseStockContent[$key]);
            }
        }
        if ($action == "Stock" || $action == null) {
            $WarehouseStockContent = KitStock::with(
                'user',
                'warehouse_stock',
                'kit',
                'kit.product',
                'kit.product.product_category',
                'kit.product.product_type',
                'kit.product.product_brand',
                'kit.product.product_collection',
                'kit.product.product_model',
                'kit.product.product_color',
                'kit.product.product_material',
                'kit.product.product_country'
            )->get()->where('warehouse_stock.warehouse_id', $warehouse);
            foreach ($WarehouseStockContent as $key => $value) {
                $WarehouseStockContent[$key]["dataType"] = "StockKit";
                $WarehouseStockContent[$key]["date"] = $WarehouseStockContent[$key]["warehouse_stock"]["date"];
                $actionData->push($WarehouseStockContent[$key]);
            }
        }
        if ($action == "IncomingInvoice" || $action == null) {
            $IncomingInvoiceContent = IncomingInvoiceContent::with(
                'user',
                'incoming_invoice',
                'incoming_invoice.people',
                'incoming_invoice.warehouse',
                'incoming_invoice.cash',
                'product',
                'product.product_category',
                'product.product_type',
                'product.product_brand',
                'product.product_collection',
                'product.product_model',
                'product.product_color',
                'product.product_material',
                'product.product_country'
            )->get()->where('incoming_invoice.warehouse_id', $warehouse);
            foreach ($IncomingInvoiceContent as $key => $value) {
                $IncomingInvoiceContent[$key]["dataType"] = "IncomingInvoice";
                $IncomingInvoiceContent[$key]["date"] = $IncomingInvoiceContent[$key]["incoming_invoice"]["date"];
                $actionData->push($IncomingInvoiceContent[$key]);
            }
        }
        if ($action == "IncomingInvoice" || $action == null) {
            $IncomingInvoiceKit = IncomingInvoiceKit::with(
                'user',
                'incoming_invoice',
                'incoming_invoice.people',
                'incoming_invoice.warehouse',
                'incoming_invoice.cash',
                'incoming_invoice.incoming_invoice_kits',
                'kit',
                'kit.product',
                'kit.product.product_category',
                'kit.product.product_type',
                'kit.product.product_brand',
                'kit.product.product_collection',
                'kit.product.product_model',
                'kit.product.product_color',
                'kit.product.product_material',
                'kit.product.product_country'
            )->get()->where('incoming_invoice.warehouse_id', $warehouse);
            foreach ($IncomingInvoiceKit as $key => $value) {
                $IncomingInvoiceKit[$key]["dataType"] = "IncomingInvoiceKit";
                $actionData->push($IncomingInvoiceKit[$key]);
            }
        }
        if ($action == "ReturnedIncomingInvoice" || $action == null) {
            $ReturnedIncomingInvoice = ReturnedIncomingInvoice::with([
                'user',
                'incoming_invoice',
                'incoming_invoice.people',
                'incoming_invoice.warehouse',
                'incoming_invoice.cash',
                'product',
                'product.product_category',
                'product.product_type',
                'product.product_brand',
                'product.product_collection',
                'product.product_model',
                'product.product_color',
                'product.product_material',
                'product.product_country'
            ])->get()->where('incoming_invoice.warehouse_id', $warehouse);
            foreach ($ReturnedIncomingInvoice as $key => $value) {
                $ReturnedIncomingInvoice[$key]["dataType"] = "ReturnedIncomingInvoice";
                $actionData->push($ReturnedIncomingInvoice[$key]);
            }
        }
        if ($action == "ReturnedIncomingInvoice" || $action == null) {
            $ReturnedIncomingInvoiceKit = ReturnedIncomingInvoiceKit::with(
                'user',
                'incoming_invoice',
                'incoming_invoice.people',
                'incoming_invoice.warehouse',
                'incoming_invoice.cash',
                'incoming_invoice.incoming_invoice_kits',
                'kit',
                'kit.product',
                'kit.product.product_category',
                'kit.product.product_type',
                'kit.product.product_brand',
                'kit.product.product_collection',
                'kit.product.product_model',
                'kit.product.product_color',
                'kit.product.product_material',
                'kit.product.product_country'
            )->get()->where('incoming_invoice.warehouse_id', $warehouse);
            foreach ($ReturnedIncomingInvoiceKit as $key => $value) {
                $ReturnedIncomingInvoiceKit[$key]["dataType"] = "ReturnedIncomingInvoiceKit";
                $actionData->push($ReturnedIncomingInvoiceKit[$key]);
            }
        }
        if ($action == "OutgoingInvoice" || $action == null) {
            $OutgoingInvoiceContent = OutgoingInvoiceContent::with(
                'user',
                'outgoing_invoice',
                'outgoing_invoice.people',
                'outgoing_invoice.cash',
                'product',
                'product.product_category',
                'product.product_type',
                'product.product_brand',
                'product.product_collection',
                'product.product_model',
                'product.product_color',
                'product.product_material',
                'product.product_country'
            )->get()->where('outgoing_invoice.warehouse_id', $warehouse);
            foreach ($OutgoingInvoiceContent as $key => $value) {
                $OutgoingInvoiceContent[$key]["dataType"] = "OutgoingInvoice";
                $OutgoingInvoiceContent[$key]["date"] = $OutgoingInvoiceContent[$key]["outgoing_invoice"]["date"];
                $actionData->push($OutgoingInvoiceContent[$key]);
            }
        }
        if ($action == "OutgoingInvoice" || $action == null) {
            $OutgoingInvoiceKit = OutgoingInvoiceKit::with(
                'user',
                'outgoing_invoice',
                'outgoing_invoice.people',
                'outgoing_invoice.warehouse',
                'outgoing_invoice.cash',
                'outgoing_invoice.outgoing_invoice_kits',
                'kit',
                'kit.product',
                'kit.product.product_category',
                'kit.product.product_type',
                'kit.product.product_brand',
                'kit.product.product_collection',
                'kit.product.product_model',
                'kit.product.product_color',
                'kit.product.product_material',
                'kit.product.product_country'
            )->get()->where('outgoing_invoice.warehouse_id', $warehouse);
            foreach ($OutgoingInvoiceKit as $key => $value) {
                $OutgoingInvoiceKit[$key]["dataType"] = "OutgoingInvoiceKit";
                $actionData->push($OutgoingInvoiceKit[$key]);
            }
        }
        if ($action == "ReturnedOutgoingInvoice" || $action == null) {
            $ReturnedOutgoingInvoice = ReturnedOutgoingInvoice::with(
                'user',
                'outgoing_invoice',
                'outgoing_invoice.people',
                'outgoing_invoice.warehouse',
                'outgoing_invoice.cash',
                'product',
                'product.product_category',
                'product.product_type',
                'product.product_brand',
                'product.product_collection',
                'product.product_model',
                'product.product_color',
                'product.product_material',
                'product.product_country'
            )->get()->where('outgoing_invoice.warehouse_id', $warehouse);
            foreach ($ReturnedOutgoingInvoice as $key => $value) {
                $ReturnedOutgoingInvoice[$key]["dataType"] = "ReturnedOutgoingInvoice";
                $actionData->push($ReturnedOutgoingInvoice[$key]);
            }
        }
        if ($action == "ReturnedOutgoingInvoiceKit" || $action == null) {
            $ReturnedOutgoingInvoiceKit = ReturnedOutgoingInvoiceKit::with(
                'user',
                'outgoing_invoice',
                'outgoing_invoice.people',
                'outgoing_invoice.warehouse',
                'outgoing_invoice.cash',
                'outgoing_invoice.outgoing_invoice_kits',
                'kit',
                'kit.product',
                'kit.product.product_category',
                'kit.product.product_type',
                'kit.product.product_brand',
                'kit.product.product_collection',
                'kit.product.product_model',
                'kit.product.product_color',
                'kit.product.product_material',
                'kit.product.product_country'
            )->get()->where('outgoing_invoice.warehouse_id', $warehouse);
            foreach ($ReturnedOutgoingInvoiceKit as $key => $value) {
                $ReturnedOutgoingInvoiceKit[$key]["dataType"] = "ReturnedOutgoingInvoiceKit";
                $actionData->push($ReturnedOutgoingInvoiceKit[$key]);
            }
        }
        if ($action == "TransferFrom" || $action == null) {
            $TransferContent = TransferContent::with(
                'user',
                'transfer',
                'transfer.warehouse_from',
                'transfer.warehouse_to',
                'transfer.driver',
                'product',
                'product.product_category',
                'product.product_type',
                'product.product_brand',
                'product.product_collection',
                'product.product_model',
                'product.product_color',
                'product.product_material',
                'product.product_country'
            )->get()->where('transfer.warehouse_from_id', $warehouse);
            foreach ($TransferContent as $key => $value) {
                $TransferContent[$key]["dataType"] = "TransferFrom";
                $TransferContent[$key]["date"] = $TransferContent[$key]["transfer"]["date"];
                $actionData->push($TransferContent[$key]);
            }
        }
        if ($action == "TransferFrom" || $action == null) {
            $TransferContent = TransferKit::with(
                'user',
                'transfer',
                'transfer.warehouse_from',
                'transfer.warehouse_to',
                'transfer.driver',
                'kit',
                'kit.product',
                'kit.product.product_category',
                'kit.product.product_type',
                'kit.product.product_brand',
                'kit.product.product_collection',
                'kit.product.product_model',
                'kit.product.product_color',
                'kit.product.product_material',
                'kit.product.product_country'
            )->get()->where('transfer.warehouse_from_id', $warehouse);
            foreach ($TransferContent as $key => $value) {
                $TransferContent[$key]["dataType"] = "TransferFromKit";
                $TransferContent[$key]["date"] = $TransferContent[$key]["transfer"]["date"];
                $actionData->push($TransferContent[$key]);
            }
        }
        if ($action == "TransferTo" || $action == null) {
            $TransferContent = TransferContent::with(
                'user',
                'transfer',
                'transfer.warehouse_from',
                'transfer.warehouse_to',
                'transfer.driver',
                'product',
                'product.product_category',
                'product.product_type',
                'product.product_brand',
                'product.product_collection',
                'product.product_model',
                'product.product_color',
                'product.product_material',
                'product.product_country'
            )->get()->where('transfer.warehouse_to_id', $warehouse);
            foreach ($TransferContent as $key => $value) {
                $TransferContent[$key]["dataType"] = "TransferTo";
                $TransferContent[$key]["date"] = $TransferContent[$key]["transfer"]["date"];
                $actionData->push($TransferContent[$key]);
            }
        }
        if ($action == "TransferTo" || $action == null) {
            $TransferContent = TransferKit::with(
                'user',
                'transfer',
                'transfer.warehouse_from',
                'transfer.warehouse_to',
                'transfer.driver',
                'kit',
                'kit.product',
                'kit.product.product_category',
                'kit.product.product_type',
                'kit.product.product_brand',
                'kit.product.product_collection',
                'kit.product.product_model',
                'kit.product.product_color',
                'kit.product.product_material',
                'kit.product.product_country'
            )->get()->where('transfer.warehouse_to_id', $warehouse);
            foreach ($TransferContent as $key => $value) {
                $TransferContent[$key]["dataType"] = "TransferToKit";
                $TransferContent[$key]["date"] = $TransferContent[$key]["transfer"]["date"];
                $actionData->push($TransferContent[$key]);
            }
        }
        if ($action == "DestructibleGoods" || $action == null) {
            $DestructibleGoodsAction = DestructibleGoodsAction::with('user', 'destructible_goods',  'destructible_goods.warehouse')->whereRelation('destructible_goods', 'warehouse_id', $warehouse)->get();
            foreach ($DestructibleGoodsAction as $key => $value) {
                $DestructibleGoodsAction[$key]["dataType"] = "DestructibleGoods";
                $actionData->push($DestructibleGoodsAction[$key]);
            }
        }
        if ($action == "KitOperation" || $action == null) {
            $KitOperation = KitOperation::with('user', 'warehouse')->where('warehouse_id', $warehouse)->get();
            foreach ($KitOperation as $key => $value) {
                $KitOperation[$key]["dataType"] = "KitOperation";
                $actionData->push($KitOperation[$key]);
            }
        }
        
        $actionData = $actionData->sortByDesc('date');
        return $actionData->paginate();
    }
    public function isEmptyCount()
    {

        $products = Product::all();
        $warehouse = Warehouse::all();
        $empty = 0;
        foreach ($warehouse as $key1 => $value) {
            $isEmpty = true;
            foreach ($products as $key => $value) {
                $quantity = 0;
                $quantity += WarehouseStockContent::with('warehouse_stock')->where('product_id', $products[$key]['id'])->get()->where('warehouse_stock.warehouse_id', $warehouse[$key1]['id'])->sum('quantity');
                $quantity += IncomingInvoiceContent::with('incoming_invoice')->where('product_id', $products[$key]['id'])->get()->where('incoming_invoice.warehouse_id',  $warehouse[$key1]['id'])->sum('quantity');
                $quantity += ReturnedOutgoingInvoice::with('outgoing_invoice')->where('product_id', $products[$key]['id'])->get()->where('outgoing_invoice.warehouse_id',  $warehouse[$key1]['id'])->sum('quantity');
                if ($quantity > 0) {
                    $isEmpty = false;
                    break 1;
                }
                $quantity -= ReturnedIncomingInvoice::with('incoming_invoice')->where('product_id', $products[$key]['id'])->get()->where('incoming_invoice.warehouse_id',  $warehouse[$key1]['id'])->sum('quantity');
                $quantity -= OutgoingInvoiceContent::with('outgoing_invoice')->where('product_id', $products[$key]['id'])->get()->where('outgoing_invoice.warehouse_id',  $warehouse[$key1]['id'])->sum('quantity');
                $quantity -= OutgoingInvoiceContent::with('outgoing_invoice')->where('product_id', $products[$key]['id'])->get()->where('outgoing_invoice.warehouse_id',  $warehouse[$key1]['id'])->sum('quantity');
                $quantity -= DestructibleGoodsAction::where('action', 1)->whereRelation('destructible_goods', 'warehouse_id', $warehouse[$key1]['id'])->whereRelation('destructible_goods', 'product_id', $products[$key]['id'])->count();
                if ($quantity > 0) {
                    $isEmpty = false;
                    break 1;
                }
            }
            if ($isEmpty) {
                $kits = Kit::all();
                foreach ($kits as $key => $value) {
                    $quantity = KitStock::with('warehouse_stock')->where('kit_id', $kits[$key]['id'])->get()->where('warehouse_stock.warehouse_id',  $warehouse[$key1]['id'])->sum('quantity');
                    $quantity += IncomingInvoiceKit::with('incoming_invoice')->where('kit_id', $kits[$key]['id'])->get()->where('incoming_invoice.warehouse_id',  $warehouse[$key1]['id'])->sum('quantity');
                    $quantity += ReturnedOutgoingInvoiceKit::with('outgoing_invoice')->where('kit_id', $kits[$key]['id'])->get()->where('outgoing_invoice.warehouse_id',  $warehouse[$key1]['id'])->sum('quantity');
                    if ($quantity > 0) {
                        $isEmpty = false;
                        break 1;
                    }
                    $quantity -= KitOperation::where('kit_id', $kits[$key]['id'])->where('warehouse_id',  $warehouse[$key1]['id'])->sum('quantity');
                    $quantity -= ReturnedIncomingInvoiceKit::with('incoming_invoice')->where('kit_id', $kits[$key]['id'])->get()->where('incoming_invoice.warehouse_id',  $warehouse[$key1]['id'])->sum('quantity');
                    $quantity -= OutgoingInvoiceKit::with('outgoing_invoice')->where('kit_id', $kits[$key]['id'])->get()->where('outgoing_invoice.warehouse_id',  $warehouse[$key1]['id'])->sum('quantity');
                    if ($quantity > 0) {
                        $isEmpty = false;
                        break 1;
                    }
                }
            }
            if ($isEmpty) {
                $empty++;
            }
        }
        return $empty;
    }
}
