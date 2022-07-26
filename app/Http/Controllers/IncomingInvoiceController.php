<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIncomingInvoiceContentRequest;
use App\Models\IncomingInvoice;
use App\Http\Requests\StoreIncomingInvoiceRequest;
use App\Http\Requests\UpdateIncomingInvoiceRequest;
use App\Models\Cash;
use App\Models\IncomingInvoiceAttachment;
use App\Models\IncomingInvoiceContent;
use App\Models\People;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class IncomingInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('IncomingInvoice/IncomingInvoice', [
            "incomingInvoice" => IncomingInvoice::with('users')->with('supplier')->with('warehouse')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('IncomingInvoice/CreateIncomingInvoice', [
            "products" => Product::with('product_country', 'product_material', 'product_color', 'product_model', 'product_collection', 'product_brand', 'product_type', 'product_category')->get(),
            "cash" => Cash::all(),
            "warehouses" => Warehouse::all(),
            "suppliers" => People::orderByDesc("type")->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIncomingInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIncomingInvoiceRequest $request)
    {
        // Save the Incoming Invoice
        $invice = IncomingInvoice::create([
            'number' => $request->number,
            'pay_type' => $request->pay_type,
            'cash_id' => $request->cash_type,
            'discount' => $request->discount,
            'date' => $request->date,
            'people_id' => $request->supplier,
            'warehouse_id' => $request->warehouses,
            'user_id' => Auth::id()
        ]);

        // Save Attachment Of Incoming Invoice
        for ($i = 0; $i <  count($request["attachment"]); $i++) {
            if ($request["attachment"][$i]["attachment"] != null) {
                $attachment_path = $request["attachment"][$i]["attachment"]->store('attachment/incomingInvoice', 'public');
                IncomingInvoiceAttachment::create([
                    'attachment' =>  $attachment_path,
                    'incoming_invoice_id' => $invice['id'],
                    'user_id' => Auth::id()
                ]);
            }
        }

        // Save The Content Of Incoming Invoice
        for ($i = 0; $i <  count($request["content"]); $i++) {
            IncomingInvoiceContent::create([
                'product_id' => $request["content"][$i]["product"],
                'price' => $request["content"][$i]["price"],
                'quantity' => $request["content"][$i]["quantity"],
                'incoming_invoice_id' => $invice['id'],
                'user_id' => Auth::id()
            ]);
        }
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IncomingInvoice  $incomingInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(IncomingInvoice $incomingInvoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IncomingInvoice  $incomingInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(IncomingInvoice $incomingInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIncomingInvoiceRequest  $request
     * @param  \App\Models\IncomingInvoice  $incomingInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIncomingInvoiceRequest $request, IncomingInvoice $incomingInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IncomingInvoice  $incomingInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(IncomingInvoice $incomingInvoice)
    {
        //
    }
}
