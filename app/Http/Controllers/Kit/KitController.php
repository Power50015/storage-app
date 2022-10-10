<?php

namespace App\Http\Controllers\Kit;

use App\Http\Controllers\Controller;
use App\Models\Kit\Kit;
use App\Http\Requests\Kit\StoreKitRequest;
use App\Http\Requests\Kit\UpdateKitRequest;
use App\Models\IncomingInvoice\IncomingInvoiceKit;
use Illuminate\Support\Facades\Request;
use App\Models\Product\Product;
use App\Models\Warehouse\KitStock;
use App\Models\Warehouse\Warehouse;
use Illuminate\Support\Facades\Redirect;

// use App\Models\Cash;
// use App\Models\IncomingInvoiceContent;
// use App\Models\IncomingInvoiceKit;
// use App\Models\Kit\KitAttachment;
// use App\Models\Kit\KitImage;
// use App\Models\Kit\KitNote;
// use App\Models\Kit\KitStock;
// use App\Models\OutgoingInvoiceContent;
// use App\Models\People\People;

// use App\Models\TransferContent;

// use App\Models\WarehouseStockContent;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Redirect;
// use Illuminate\Support\Facades\Storage;
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
    public function show(Kit $kit)
    {
        $warehouses = Warehouse::all();
        $warehousesData = [];

        //  where warehouse is
        foreach ($warehouses as $key => $value) {
            $warehouse = $warehouses[$key]['id'];
            $quantity = 0;
            $quantity += KitStock::with('warehouse_stock')->where('kit_id', $kit->id)->whereRelation('warehouse_stock', 'warehouse_id', $warehouse)->sum('quantity');
            $quantity += IncomingInvoiceKit::with('incoming_invoice')->where('kit_id', $kit->id)->whereRelation('incoming_invoice', 'warehouse_id', $warehouse)->sum('quantity');
            $warehousesData[] = [
                "warehouse" => $warehouses[$key],
                "quantity" => $quantity
            ];
        }
        // dd($warehousesData);
        /* $incomeIvoice = IncomingInvoiceKit::with(['incoming_invoice', 'incoming_invoice.people'])->where('kit_id', $kit->id)->get();
        $stratStock = KitStock::with('warehouse_stock')->where('kit_id', $kit->id)->get();
        $stockData = [];

        //incomeIvoice
        for ($i = 0; $i < count($incomeIvoice); $i++) {
            $stockData[$i] = $incomeIvoice[$i];
            $stockData[$i]["type"] = "فاتورة وارده";
        }

        //stratStock
        for ($i = count($incomeIvoice), $x = 0; $i < (count($incomeIvoice)  + count($stratStock)); $i++, $x++) {
            $stockData[$i] = $stratStock[$x];
            $stockData[$i]["type"] = "مخزون";
        }

        return Inertia::render('Kit/ShowKit', [
            "kit" => Kit::with('product', 'product.product_country', 'product.product_material', 'product.product_color', 'product.product_model', 'product.product_collection', 'product.product_brand', 'product.product_type', 'product.product_category')->where('id', $kit->id)->get(),
            "stockData" => $stockData,
            "incomeIvoice" => $incomeIvoice,
            "stratStock" => $stratStock,
            "note" => KitNote::where('kit_id', $kit->id)->get(),
            "attachment" => KitAttachment::where('kit_id', $kit->id)->get(),
            "image" => KitImage::where('kit_id', $kit->id)->get(),
        ]);*/
        return Inertia::render('Kit/ShowKit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function edit(Kit $kit)
    {
        /*return Inertia::render('Kit/EditKit', [
            "kit" => Kit::with('product', 'product.product_country', 'product.product_material', 'product.product_color', 'product.product_model', 'product.product_collection', 'product.product_brand', 'product.product_type', 'product.product_category')->where('id', $kit->id)->get(),
            "products" => Product::with('product_country', 'product_material', 'product_color', 'product_model', 'product_collection', 'product_brand', 'product_type', 'product_category')->get(),

        ]);*/
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
}
