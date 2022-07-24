<?php

namespace App\Http\Controllers;

use App\Models\OutgoingInvoice;
use App\Http\Requests\StoreOutgoingInvoiceRequest;
use App\Http\Requests\UpdateOutgoingInvoiceRequest;
use App\Models\Cash;
use App\Models\OutgoingInvoiceAttachment;
use App\Models\OutgoingInvoiceContent;
use App\Models\People;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class OutgoingInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return Inertia::render('OutgoingInvoice/CreateOutgoingInvoice', [
        //     "outgoingInvoice" => OutgoingInvoice::with('users')->get(),
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('OutgoingInvoice/CreateOutgoingInvoice', [
            "products" => Product::with('country')->with('country', 'material', 'color', 'model', 'collection', 'brand', 'type', 'category')->get(),
            "cash" => Cash::all(),
            "warehouses" => Warehouse::all(),
            "customers" => People::orderBy("type")->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOutgoingInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOutgoingInvoiceRequest $request)
    {
        // Save the Incoming Invoice
        $invice = OutgoingInvoice::create([
            'pay_type' => $request->pay_type,
            'cash_type' => $request->cash_type,
            'discount' => $request->discount,
            'date' => $request->date,
            'customer' => $request->customer,
            'warehouse' => $request->warehouses,
            'user' => Auth::id()
        ]);

        // Save Attachment Of Incoming Invoice
        for ($i = 0; $i <  count($request["attachment"]); $i++) {
            if($request["attachment"][$i]["attachment"] != null)
            {
                $attachment_path = $request["attachment"][$i]["attachment"]->store('attachment/outgoingInvoice', 'public');
                OutgoingInvoiceAttachment::create([
                'attachment' =>  $attachment_path,
                'outgoing_invoice' => $invice['id'],
                'user' => Auth::id()
            ]);
            }
        }

        // Save The Content Of Incoming Invoice
        for ($i = 0; $i <  count($request["content"]); $i++) {
            OutgoingInvoiceContent::create([
                'product' => $request["content"][$i]["product"],
                'price' => $request["content"][$i]["price"],
                'quantity' => $request["content"][$i]["quantity"],
                'outgoing_invoice' => $invice['id'],
                'user' => Auth::id()
            ]);
        }
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OutgoingInvoice  $outgoingInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(OutgoingInvoice $outgoingInvoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OutgoingInvoice  $outgoingInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(OutgoingInvoice $outgoingInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOutgoingInvoiceRequest  $request
     * @param  \App\Models\OutgoingInvoice  $outgoingInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOutgoingInvoiceRequest $request, OutgoingInvoice $outgoingInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OutgoingInvoice  $outgoingInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(OutgoingInvoice $outgoingInvoice)
    {
        //
    }
}
