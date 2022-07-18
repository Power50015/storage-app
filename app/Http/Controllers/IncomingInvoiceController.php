<?php

namespace App\Http\Controllers;

use App\Models\IncomingInvoice;
use App\Http\Requests\StoreIncomingInvoiceRequest;
use App\Http\Requests\UpdateIncomingInvoiceRequest;
use App\Models\Product;
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('CreateIncomingInvoice', [
            "products" =>
            Product::with('users')->with('country')->with('material')->with('color')->with('model')->with('collection')->with('brand')->with('type')->with('category')->get()
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
        dd($request);
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
