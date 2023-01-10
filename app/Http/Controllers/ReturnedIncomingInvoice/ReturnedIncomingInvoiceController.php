<?php

namespace App\Http\Controllers\ReturnedIncomingInvoice;

use App\Http\Controllers\Controller;
use App\Models\IncomingInvoice\ReturnedIncomingInvoice;
use App\Http\Requests\ReturnedIncomingInvoice\StoreReturnedIncomingInvoiceRequest;
use App\Http\Requests\ReturnedIncomingInvoice\UpdateReturnedIncomingInvoiceRequest;
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
            "incomingInvoiceKit" => IncomingInvoiceKit::with('kit', 'kit.product', 'kit.product.product_country', 'kit.product.product_material', 'kit.product.product_color', 'kit.product.product_model', 'kit.product.product_collection', 'kit.product.product_brand', 'kit.product.product_type', 'kit.product.product_category')->where('incoming_invoice_id', $returnedIncomingInvoice)->get(),

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

        $invoice = IncomingInvoice::find($request->id);
        $totalPrice = 0;

        if (!is_null($request["content"]))
            for ($i = 0; $i <  count($request["content"]); $i++)
                $totalPrice = $totalPrice + ($request["content"][$i]["price"] * $request["content"][$i]["quantity"]);

        if (!is_null($request["kit"]))
            for ($i = 0; $i <  count($request["kit"]); $i++)
                $totalPrice = $totalPrice + ($request["kit"][$i]["price"] * $request["kit"][$i]["quantity"]);


        $invoice->total = $invoice->total -  $totalPrice;

        // Save The Content Of Incoming Invoice.
        ReturnedIncomingInvoice::where('incoming_invoice_id', $returnedIncomingInvoice)->delete();

        for ($i = 0; $i <  count($request["content"]); $i++) {
            if ($request["content"][$i]["quantity"] > 0)
                ReturnedIncomingInvoice::create([
                    'product_id' => $request["content"][$i]["product_id"],
                    'quantity' => $request["content"][$i]["quantity"],
                    'incoming_invoice_id' => $request->id,
                    'price' => $request["content"][$i]["price"],
                    'date' => $request->date,
                    'user_id' => Auth::id(),
                    'people_id' => $request->people_id,
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
                    'price' => $request["content"][$i]["price"],
                    'date' => $request->date,
                    'user_id' => Auth::id(),
                    'people_id' => $request->people_id,
                ]);
        }

        return redirect()->route('incoming-invoice.show', $request->id);
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
