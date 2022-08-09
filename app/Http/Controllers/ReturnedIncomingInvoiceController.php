<?php

namespace App\Http\Controllers;

use App\Models\ReturnedIncomingInvoice;
use App\Http\Requests\StoreReturnedIncomingInvoiceRequest;
use App\Http\Requests\UpdateReturnedIncomingInvoiceRequest;
use App\Models\IncomingInvoice;
use App\Models\IncomingInvoiceAttachment;
use App\Models\IncomingInvoiceContent;
use App\Models\Product;
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
            ReturnedIncomingInvoice::create([
                'product_id' => $request["content"][$i]["product_id"],
                'quantity' => $request["content"][$i]["quantity"],
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
