<?php

namespace App\Http\Controllers\Kit;

use App\Http\Controllers\Controller;
use App\Models\Kit\Kit;
use App\Http\Requests\Kit\StoreKitRequest;
use App\Http\Requests\Kit\UpdateKitRequest;
use App\Models\IncomingInvoice\IncomingInvoiceKit;
use App\Models\IncomingInvoice\ReturnedIncomingInvoiceKit;
use App\Models\Kit\KitAttachment;
use App\Models\Kit\KitImage;
use App\Models\Kit\KitNote;
use App\Models\Kit\KitOperation;
use App\Models\OutgoingInvoice\OutgoingInvoiceKit;
use App\Models\OutgoingInvoice\ReturnedOutgoingInvoiceKit;
use Illuminate\Support\Facades\Request;
use App\Models\Product\Product;
use App\Models\Transfer\TransferKit;
use App\Models\Warehouse\KitStock;
use App\Models\Warehouse\Warehouse;
use Illuminate\Support\Facades\Redirect;
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
            "kits" =>  Kit::with(
                'product',
                'product.product_country',
                'product.product_material',
                'product.product_color',
                'product.product_model',
                'product.product_collection',
                'product.product_brand',
                'product.product_type',
                'product.product_category'
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
                    ->orWhereRelation('product.product_country', 'name', 'like', "%{$search}%");
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
        return Inertia::render('Kit/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreKitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKitRequest $request)
    {
        Kit::create(array_merge(
            $request->all(),
            [
                'user_id' => auth()->user()->id,
                'image' => $request->hasFile('image') ? $request->file('image')->store('image/kit', 'public') : 'no_image.png'
            ]
        ));

        return Redirect::back();
        /* 
        // Save Attachment Of Kit
        if (!is_null($request["attachment"]))
            for ($i = 0; $i <  count($request["attachment"]); $i++) {
                if ($request["attachment"][$i]["attachment"] != null) {
                    $attachment_path = $request["attachment"][$i]["attachment"]->store('attachment/kit', 'public');
                    KitAttachment::create([
                        'attachment' =>  $attachment_path,
                        'kit_id' => $kit['id'],
                        'user_id' => Auth::id()
                    ]);
                }
            }


        // Save The Notes Of Product
        if (!is_null($request["note"]))
            for ($i = 0; $i <  count($request["note"]); $i++) {
                KitNote::create([
                    'note' => $request["note"][$i]["note"],
                    'kit_id' => $kit['id'],
                    'user_id' => Auth::id()
                ]);
            }

        // Save The Images Of Product
        if (!is_null($request["images"]))
            for ($i = 0; $i <  count($request["images"]); $i++) {
                if ($request["images"][$i]["image"] != null) {
                    $attachment_path = $request["images"][$i]["image"]->store('image/kits', 'public');
                    KitImage::create([
                        'image' =>  $attachment_path,
                        'kit_id' => $kit['id'],
                        'user_id' => Auth::id()
                    ]);
                }
            }
*/

        // Save The Content Of Incoming Invoice
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function show($kit)
    {
        
        return Inertia::render('Kit/Show', [
            "kit" => Kit::with('product', 'product.product_country', 'product.product_material', 'product.product_color', 'product.product_model', 'product.product_collection', 'product.product_brand', 'product.product_type', 'product.product_category')->where('id', $kit)->get(),
            // "warehousesData" => $warehousesData->values()->all(),
            // "actionData" => $actionData->values()->all(),
            "note" => KitNote::where('kit_id', $kit)->get(),
            "attachment" => KitAttachment::where('kit_id', $kit)->get(),
            "image" => KitImage::where('kit_id', $kit)->get(),
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
        return Inertia::render('Kit/Edit', [
            "kit" => Kit::with('product', 'product.product_country', 'product.product_material', 'product.product_color', 'product.product_model', 'product.product_collection', 'product.product_brand', 'product.product_type', 'product.product_category')->where('id', $kit->id)->get(),
            "products" => Product::with('product_country', 'product_material', 'product_color', 'product_model', 'product_collection', 'product_brand', 'product_type', 'product_category')->get(),

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
        /* $image_path = '';
        if ($request->hasFile('image')) {
            Storage::delete("public/" . $request->image);
            $image_path = $request->file('image')->store('image/kit', 'public');
        } else {
            $image_path = $request->oldImage;
        }

        $kit = DB::table('kits')->where('id', $kit->id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'product_id' => $request->product,
            'image' =>  $image_path,
            'user_id' => Auth::id()
        ]);

        return Redirect::back();*/
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
            $KitStock = KitStock::with(['warehouse_stock', 'warehouse_stock.warehouse'])->where('kit_id', $kit)->get();
            foreach ($KitStock as $key => $value) {
                $KitStock[$key]["dataType"] = "Stock";
                $KitStock[$key]["date"] = $KitStock[$key]["warehouse_stock"]["date"];
                $actionData->push($KitStock[$key]);
            }
        }
        if ($action == "IncomingInvoice" || $action == "all") {
            //  Incoming Invoice
            $IncomingInvoiceKit = IncomingInvoiceKit::with(['incoming_invoice', 'incoming_invoice.warehouse'])->where('kit_id', $kit)->get();
            foreach ($IncomingInvoiceKit as $key => $value) {
                $IncomingInvoiceKit[$key]["dataType"] = "IncomingInvoice";
                $IncomingInvoiceKit[$key]["date"] = $IncomingInvoiceKit[$key]["incoming_invoice"]["date"];
                $actionData->push($IncomingInvoiceKit[$key]);
            }
        }
        //  Returned Incoming Invoice
        if ($action == "ReturnedIncomingInvoice" || $action == "all") {
            $ReturnedIncomingInvoiceKit = ReturnedIncomingInvoiceKit::with(['incoming_invoice', 'incoming_invoice.warehouse'])->where('kit_id', $kit)->get();
            foreach ($ReturnedIncomingInvoiceKit as $key => $value) {
                $ReturnedIncomingInvoiceKit[$key]["dataType"] = "ReturnedIncomingInvoice";
                $actionData->push($ReturnedIncomingInvoiceKit[$key]);
            }
        }
        //  Transfer
        if ($action == "Transfer" || $action == "all") {
            $TransferKit = TransferKit::with(['transfer', 'transfer.warehouse_from', 'transfer.warehouse_to'])->where('kit_id', $kit)->get();
            foreach ($TransferKit as $key => $value) {
                $TransferKit[$key]["dataType"] = "Transfer";
                $TransferKit[$key]["date"] = $TransferKit[$key]["transfer"]["date"];
                $actionData->push($TransferKit[$key]);
            }
        }
        //  Outgoing Invoice
        if ($action == "OutgoingInvoice" || $action == "all") {

            $OutgoingInvoiceKit = OutgoingInvoiceKit::with('outgoing_invoice', 'outgoing_invoice.warehouse')->where('kit_id', $kit)->get();
            foreach ($OutgoingInvoiceKit as $key => $value) {
                $OutgoingInvoiceKit[$key]["dataType"] = "OutgoingInvoice";
                $OutgoingInvoiceKit[$key]["date"] = $OutgoingInvoiceKit[$key]["outgoing_invoice"]["date"];

                $actionData->push($OutgoingInvoiceKit[$key]);
            }
        }
        //  Returned Outgoing Invoice
        if ($action == "ReturnedOutgoingInvoice" || $action == "all") {

            $ReturnedOutgoingInvoiceKit = ReturnedOutgoingInvoiceKit::with('outgoing_invoice', 'outgoing_invoice.warehouse')->where('kit_id', $kit)->get();
            foreach ($ReturnedOutgoingInvoiceKit as $key => $value) {
                $ReturnedOutgoingInvoiceKit[$key]["dataType"] = "ReturnedOutgoingInvoice";
                $actionData->push($ReturnedOutgoingInvoiceKit[$key]);
            }
        }
        //  Oprtion
        if ($action == "KitOperation" || $action == "all") {

            $KitOperation = KitOperation::with('warehouse')->where('kit_id', $kit)->get();
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
        $warehouses = Warehouse::all();
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
}
