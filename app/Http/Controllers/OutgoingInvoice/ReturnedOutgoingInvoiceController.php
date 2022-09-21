<?php

namespace App\Http\Controllers;

use App\Models\ReturnedOutgoingInvoice;
use App\Http\Requests\StoreReturnedOutgoingInvoiceRequest;
use App\Http\Requests\UpdateReturnedOutgoingInvoiceRequest;
use App\Models\OutgoingInvoice;
use App\Models\OutgoingInvoiceAttachment;
use App\Models\OutgoingInvoiceContent;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ReturnedOutgoingInvoiceController extends Controller
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
     * @param  \App\Http\Requests\StoreReturnedOutgoingInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReturnedOutgoingInvoiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnedOutgoingInvoice  $returnedOutgoingInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(ReturnedOutgoingInvoice $returnedOutgoingInvoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnedOutgoingInvoice  $returnedOutgoingInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit($returnedOutgoingInvoice)
    {
        return Inertia::render('OutgoingInvoice/ReturnedOutgoingInvoice', [
            "outgoingInvoice" => OutgoingInvoice::where('id', $returnedOutgoingInvoice)->with('user', 'people', 'warehouse', 'cash')->get(),
            "outgoingInvoiceContent" => OutgoingInvoiceContent::with('product', 'product.product_country', 'product.product_material', 'product.product_color', 'product.product_model', 'product.product_collection', 'product.product_brand', 'product.product_type', 'product.product_category')->where('outgoing_invoice_id', $returnedOutgoingInvoice)->get(),
            "returnedOutgoingInvoice" => ReturnedOutgoingInvoice::with('product', 'product.product_country', 'product.product_material', 'product.product_color', 'product.product_model', 'product.product_collection', 'product.product_brand', 'product.product_type', 'product.product_category')->where('outgoing_invoice_id', $returnedOutgoingInvoice)->get(),
            "outgoingInvoiceAttachment" => OutgoingInvoiceAttachment::where('outgoing_invoice_id', $returnedOutgoingInvoice)->get(),
            "products" => Product::with('product_country', 'product_material', 'product_color', 'product_model', 'product_collection', 'product_brand', 'product_type', 'product_category')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReturnedOutgoingInvoiceRequest  $request
     * @param  \App\Models\ReturnedOutgoingInvoice  $returnedOutgoingInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReturnedOutgoingInvoiceRequest $request,$returnedOutgoingInvoice)
    {
                // Save New Attachment Of Outgoing Invoice

                for ($i = 0; $i <  count($request["attachment"]); $i++) {
                    if ($request["attachment"][$i]["attachment"] != null) {
                        $attachment_path = $request["attachment"][$i]["attachment"]->store('attachment/outgoingInvoice', 'public');
                        OutgoingInvoiceAttachment::create([
                            'attachment' =>  $attachment_path,
                            'outgoing_invoice_id' =>  $returnedOutgoingInvoice,
                            'user_id' => Auth::id()
                        ]);
                    }
                }
        
                // Save The Content Of Incoming Invoice.
                ReturnedOutgoingInvoice::where('outgoing_invoice_id', $returnedOutgoingInvoice)->delete();
                for ($i = 0; $i <  count($request["content"]); $i++) {
                    if ($request["content"][$i]["quantity"] > 0)
                    ReturnedOutgoingInvoice::create([
                        'product_id' => $request["content"][$i]["product_id"],
                        'quantity' => $request["content"][$i]["quantity"],
                        'outgoing_invoice_id' => $request->id,
                        'date' => $request->Rdate,
                        'user_id' => Auth::id()
                    ]);
                }
        
                return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnedOutgoingInvoice  $returnedOutgoingInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturnedOutgoingInvoice $returnedOutgoingInvoice)
    {
        //
    }
}
