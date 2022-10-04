<?php

namespace App\Http\Controllers\Kit;

use App\Http\Controllers\Controller;
use App\Models\Kit\Kit;
use App\Http\Requests\Kit\StoreKitRequest;
use App\Http\Requests\Kit\UpdateKitRequest;
// use App\Models\Cash;
// use App\Models\IncomingInvoiceContent;
// use App\Models\IncomingInvoiceKit;
// use App\Models\Kit\KitAttachment;
// use App\Models\Kit\KitImage;
// use App\Models\Kit\KitNote;
// use App\Models\Kit\KitStock;
// use App\Models\OutgoingInvoiceContent;
// use App\Models\People\People;
use App\Models\Product\Product;
// use App\Models\TransferContent;
use App\Models\Warehouse\Warehouse;
use Illuminate\Support\Facades\Redirect;
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
            )->get()
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
            "products" => Product::with('product_country', 'product_material', 'product_color', 'product_model', 'product_collection', 'product_brand', 'product_type', 'product_category')->get(),
            "warehouses" => Warehouse::all(),
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
        Kit::create(array_merge(
            $request->all(),
            [
                'user_id' => auth()->user()->id,
                'image' => $request->hasFile('image') ? $request->file('image')->store('image/kit', 'public') : 'no_image.png'
            ]
        ));

        return Redirect::back();
        /*
        $image_path = '';
        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('image/kit', 'public');
        } else {
            $image_path = 'no_image.png';
        }
        // Save the Kit
        $kit = Kit::create([
            'title' => $request->title,
            'description' => $request->description,
            'product_id' => $request->product,
            'image' =>  $image_path,
            'user_id' => Auth::id()
        ]);

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


        // Save The Content Of Incoming Invoice
        return Redirect::back();*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function show(Kit $kit)
    {
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
