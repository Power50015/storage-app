<?php

namespace App\Http\Controllers\IncomingInvoice;

use App\Http\Controllers\Controller;
use App\Models\IncomingInvoice\IncomingInvoiceImage;
use App\Http\Requests\IncomingInvoice\StoreIncomingInvoiceImageRequest;
use App\Http\Requests\IncomingInvoice\UpdateIncomingInvoiceImageRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class IncomingInvoiceImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $image = Request::input('id');
        return [
            "image" => IncomingInvoiceImage::where('incoming_invoice_id', $image)->with('user')->latest()->paginate()
        ];
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
     * @param  \App\Http\Requests\StoreIncomingInvoiceImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIncomingInvoiceImageRequest $request)
    {
        IncomingInvoiceImage::create([
            'image' =>  $request["image"]->store('image/incoming_invoice', 'public'),
            'incoming_invoice_id' => $request->id,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IncomingInvoiceImage  $incomingInvoiceImage
     * @return \Illuminate\Http\Response
     */
    public function show(IncomingInvoiceImage $incomingInvoiceImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IncomingInvoiceImage  $incomingInvoiceImage
     * @return \Illuminate\Http\Response
     */
    public function edit(IncomingInvoiceImage $incomingInvoiceImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIncomingInvoiceImageRequest  $request
     * @param  \App\Models\IncomingInvoiceImage  $incomingInvoiceImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIncomingInvoiceImageRequest $request, IncomingInvoiceImage $incomingInvoiceImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IncomingInvoiceImage  $incomingInvoiceImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(IncomingInvoiceImage $incomingInvoiceImage)
    {
        Storage::delete("public/" . $incomingInvoiceImage["image"]);
        $incomingInvoiceImage->delete();

        return Redirect::back();
    }
}
