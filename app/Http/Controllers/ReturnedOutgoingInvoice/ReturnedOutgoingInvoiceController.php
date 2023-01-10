<?php

namespace App\Http\Controllers\ReturnedOutgoingInvoice;

use App\Http\Controllers\Controller;
use App\Models\OutgoingInvoice\ReturnedOutgoingInvoice;
use App\Http\Requests\ReturnedOutgoingInvoice\StoreReturnedOutgoingInvoiceRequest;
use App\Http\Requests\ReturnedOutgoingInvoice\UpdateReturnedOutgoingInvoiceRequest;
use App\Models\OutgoingInvoice\OutgoingInvoice;
use App\Models\OutgoingInvoice\OutgoingInvoiceAttachment;
use App\Models\OutgoingInvoice\OutgoingInvoiceContent;
use App\Models\OutgoingInvoice\OutgoingInvoiceKit;
use App\Models\OutgoingInvoice\ReturnedOutgoingInvoiceKit;
use App\Models\Product\Product;
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

            "outgoingInvoiceKit" => OutgoingInvoiceKit::with('kit', 'kit.product', 'kit.product.product_country', 'kit.product.product_material', 'kit.product.product_color', 'kit.product.product_model', 'kit.product.product_collection', 'kit.product.product_brand', 'kit.product.product_type', 'kit.product.product_category')->where('outgoing_invoice_id', $returnedOutgoingInvoice)->get(),

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReturnedOutgoingInvoiceRequest  $request
     * @param  \App\Models\ReturnedOutgoingInvoice  $returnedOutgoingInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReturnedOutgoingInvoiceRequest $request, $returnedOutgoingInvoice)
    {
        $invoice = OutgoingInvoice::find($request->id);
        $totalPrice = 0;

        if (!is_null($request["content"]))
            for ($i = 0; $i <  count($request["content"]); $i++)
                $totalPrice = $totalPrice + ($request["content"][$i]["price"] * $request["content"][$i]["quantity"]);

        if (!is_null($request["kit"]))
            for ($i = 0; $i <  count($request["kit"]); $i++)
                $totalPrice = $totalPrice + ($request["kit"][$i]["price"] * $request["kit"][$i]["quantity"]);


        $invoice->total = $invoice->total -  $totalPrice;

        // Save The Content Of Outgoing Invoice.
        ReturnedOutgoingInvoice::where('outgoing_invoice_id', $returnedOutgoingInvoice)->delete();

        for ($i = 0; $i <  count($request["content"]); $i++) {
            if ($request["content"][$i]["quantity"] > 0)
                ReturnedOutgoingInvoice::create([
                    'product_id' => $request["content"][$i]["product_id"],
                    'quantity' => $request["content"][$i]["quantity"],
                    'outgoing_invoice_id' => $request->id,
                    'price' => $request["content"][$i]["price"],
                    'date' => $request->date,
                    'user_id' => Auth::id(),
                    'people_id' => $request->people_id,
                ]);
        }

        // Save The Kit Of Outgoing Invoice.
        ReturnedOutgoingInvoiceKit::where('outgoing_invoice_id', $returnedOutgoingInvoice)->delete();
        for ($i = 0; $i <  count($request["kit"]); $i++) {
            if ($request["kit"][$i]["quantity"] > 0)
            ReturnedOutgoingInvoiceKit::create([
                    'kit_id' => $request["kit"][$i]["kit_id"],
                    'quantity' => $request["kit"][$i]["quantity"],
                    'outgoing_invoice_id' => $request->id,
                    'price' => $request["content"][$i]["price"],
                    'date' => $request->date,
                    'user_id' => Auth::id(),
                    'people_id' => $request->people_id,
                ]);
        }

        return redirect()->route('outgoing-invoice.show', $request->id);
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
