<?php

namespace App\Http\Controllers\IncomingInvoice;

use App\Http\Controllers\Controller;
use App\Models\IncomingInvoice\ReturnedIncomingInvoice;
use App\Http\Requests\IncomingInvoice\StoreReturnedIncomingInvoiceRequest;
use App\Http\Requests\IncomingInvoice\UpdateReturnedIncomingInvoiceRequest;
use App\Models\IncomingInvoice\IncomingInvoice;
use App\Models\IncomingInvoice\IncomingInvoiceAttachment;
use App\Models\IncomingInvoice\IncomingInvoiceContent;
use App\Models\IncomingInvoice\IncomingInvoiceKit;
use App\Models\Kit\Kit;
use App\Models\Product\Product;
use App\Models\IncomingInvoice\ReturnedIncomingInvoiceKit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ReturnedIncomingInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreReturnedIncomingInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReturnedIncomingInvoiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnedIncomingInvoice  $returnedIncomingInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(ReturnedIncomingInvoice $returnedIncomingInvoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnedIncomingInvoice  $returnedIncomingInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit($returnedIncomingInvoice)
    {
        return Inertia::render('IncomingInvoice/ReturnedIncomingInvoice', [
            "incomingInvoice" => IncomingInvoice::where('id', $returnedIncomingInvoice)->with('user', 'people', 'warehouse', 'cash')->get(),
            "incomingInvoiceContent" => IncomingInvoiceContent::with('product', 'product.product_country', 'product.product_material', 'product.product_color', 'product.product_model', 'product.product_collection', 'product.product_brand', 'product.product_type', 'product.product_category')->where('incoming_invoice_id', $returnedIncomingInvoice)->get(),
            "returnedIncomingInvoice" => ReturnedIncomingInvoice::with('product', 'product.product_country', 'product.product_material', 'product.product_color', 'product.product_model', 'product.product_collection', 'product.product_brand', 'product.product_type', 'product.product_category')->where('incoming_invoice_id', $returnedIncomingInvoice)->get(),
            "incomingInvoiceAttachment" => IncomingInvoiceAttachment::where('incoming_invoice_id', $returnedIncomingInvoice)->get(),
            "products" => Product::with('product_country', 'product_material', 'product_color', 'product_model', 'product_collection', 'product_brand', 'product_type', 'product_category')->get(),
            "kits" => Kit::with('product', 'product.product_country', 'product.product_material', 'product.product_color', 'product.product_model', 'product.product_collection', 'product.product_brand', 'product.product_type', 'product.product_category')->get(),
            "incomingInvoiceKit" => IncomingInvoiceKit::with('kit','kit.product', 'kit.product.product_country', 'kit.product.product_material', 'kit.product.product_color', 'kit.product.product_model', 'kit.product.product_collection', 'kit.product.product_brand', 'kit.product.product_type', 'kit.product.product_category')->where('incoming_invoice_id', $returnedIncomingInvoice)->get(),

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReturnedIncomingInvoiceRequest  $request
     * @param  \App\Models\ReturnedIncomingInvoice  $returnedIncomingInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReturnedIncomingInvoiceRequest $request, $returnedIncomingInvoice)
    {

        // Save New Attachment Of Incoming Invoice

        for ($i = 0; $i <  count($request["attachment"]); $i++) {
            if ($request["attachment"][$i]["attachment"] != null) {
                $attachment_path = $request["attachment"][$i]["attachment"]->store('attachment/incomingInvoice', 'public');
                IncomingInvoiceAttachment::create([
                    'attachment' =>  $attachment_path,
                    'incoming_invoice_id' =>  $returnedIncomingInvoice,
                    'user_id' => Auth::id()
                ]);
            }
        }
        // Save The Content Of Incoming Invoice.
        ReturnedIncomingInvoice::where('incoming_invoice_id', $returnedIncomingInvoice)->delete();
        for ($i = 0; $i <  count($request["content"]); $i++) {
            if ($request["content"][$i]["quantity"] > 0)
                ReturnedIncomingInvoice::create([
                    'product_id' => $request["content"][$i]["product_id"],
                    'quantity' => $request["content"][$i]["quantity"],
                    'incoming_invoice_id' => $request->id,
                    'date' => $request->Rdate,
                    'user_id' => Auth::id()
                ]);
        }

        // Save The Kit Of Incoming Invoice.
        ReturnedIncomingInvoiceKit::where('incoming_invoice_id', $returnedIncomingInvoice)->delete();
        for ($i = 0; $i <  count($request["kit"]); $i++) {
            if ($request["kit"][$i]["quantity"] > 0)
                ReturnedIncomingInvoiceKit::create([
                    'kit_id' => $request["kit"][$i]["kit_id"],
                    'quantity' => $request["kit"][$i]["quantity"],
                    'incoming_invoice_id' => $request->id,
                    'date' => $request->Rdate,
                    'user_id' => Auth::id()
                ]);
        }

        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnedIncomingInvoice  $returnedIncomingInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturnedIncomingInvoice $returnedIncomingInvoice)
    {
        //
    }
}
