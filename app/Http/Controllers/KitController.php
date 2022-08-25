<?php

namespace App\Http\Controllers;

use App\Models\Kit;
use App\Http\Requests\StoreKitRequest;
use App\Http\Requests\UpdateKitRequest;
use App\Models\Cash;
use App\Models\KitAttachment;
use App\Models\KitImage;
use App\Models\KitNote;
use App\Models\People;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
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
        return Inertia::render('Kit/Kits', [
            "kits" =>  Kit::with('product','product.product_country', 'product.product_material', 'product.product_color', 'product.product_model', 'product.product_collection', 'product.product_brand', 'product.product_type', 'product.product_category')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Kit/CreateKit', [
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
        // $incomeIvoice = IncomingInvoiceContent::with(['incoming_invoice', 'incoming_invoice.people'])->where('product_id', $product->id)->get();
        // $outgoingIvoice = OutgoingInvoiceContent::with(['outgoing_invoice', 'outgoing_invoice.people'])->where('product_id', $product->id)->get();
        // $stratStock = WarehouseStockContent::with('warehouse_stock')->where('product_id', $product->id)->get();
        // $transfer = TransferContent::with(['transfer', 'transfer.warehouse_from', 'transfer.warehouse_to'])->where('product_id', $product->id)->get();
        // $stockData = [];

        // //incomeIvoice
        // for ($i = 0; $i < count($incomeIvoice); $i++) {
        //     $stockData[$i] = $incomeIvoice[$i];
        //     $stockData[$i]["type"] = "فاتورة وارده";
        // }
        // //outgoingIvoice
        // for ($i = count($incomeIvoice), $x = 0; $i < (count($incomeIvoice) + count($outgoingIvoice)); $i++, $x++) {
        //     $stockData[$i] = $outgoingIvoice[$x];
        //     $stockData[$i]["type"] = "فاتورة صادره";
        // }
        // //stratStock
        // for ($i = count($incomeIvoice) + count($outgoingIvoice), $x = 0; $i < (count($incomeIvoice) + count($outgoingIvoice) + count($stratStock)); $i++, $x++) {
        //     $stockData[$i] = $stratStock[$x];
        //     $stockData[$i]["type"] = "مخزون";
        // }
        // //transfer
        // for ($i = (count($incomeIvoice) + count($outgoingIvoice) + count($stratStock)), $x = 0; $i < (count($incomeIvoice) + count($outgoingIvoice) + count($stratStock) + count($transfer)); $i++, $x++) {
        //     $stockData[$i] = $transfer[$x];
        //     $stockData[$i]["type"] = "نقله";
        // }
        // return Inertia::render('Product/ShowProduct', [
        //     "product" => Product::with(['product_category', 'product_type', 'product_brand', 'product_collection', 'product_model', 'product_color', 'product_material', 'product_country', 'product_notes', 'product_images', 'product_attachments'])->where('id', $product->id)->get(),
        //     "stockData" => $stockData,
        //     "incomeIvoice" => $incomeIvoice,
        //     "outgoingIvoice" => $outgoingIvoice,
        //     "stratStock" => $stratStock,
        //     "transfer" => $transfer,
        //     "note" => ProductNote::where('product_id', $product->id)->get(),
        //     "attachment" => ProductAttachment::where('product_id', $product->id)->get(),
        //     "image" => ProductImage::where('product_id', $product->id)->get(),
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function edit(Kit $kit)
    {
        //
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
        //
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
