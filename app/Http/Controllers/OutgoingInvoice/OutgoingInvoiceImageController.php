<?php

namespace App\Http\Controllers\OutgoingInvoice;

use App\Http\Controllers\Controller;
use App\Models\OutgoingInvoice\OutgoingInvoiceImage;
use App\Http\Requests\OutgoingInvoice\StoreOutgoingInvoiceImageRequest;
use App\Http\Requests\OutgoingInvoice\UpdateOutgoingInvoiceImageRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class OutgoingInvoiceImageController extends Controller
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
            "image" => OutgoingInvoiceImage::where('outgoing_invoice_id', $image)->with('user')->latest()->paginate()
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
     * @param  \App\Http\Requests\StoreOutgoingInvoiceImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOutgoingInvoiceImageRequest $request)
    {
        OutgoingInvoiceImage::create([
            'image' =>  $request["image"]->store('image/outgoing_invoice', 'public'),
            'outgoing_invoice_id' => $request->id,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OutgoingInvoice\OutgoingInvoiceImage  $outgoingInvoiceImage
     * @return \Illuminate\Http\Response
     */
    public function show(OutgoingInvoiceImage $outgoingInvoiceImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OutgoingInvoice\OutgoingInvoiceImage  $outgoingInvoiceImage
     * @return \Illuminate\Http\Response
     */
    public function edit(OutgoingInvoiceImage $outgoingInvoiceImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOutgoingInvoiceImageRequest  $request
     * @param  \App\Models\OutgoingInvoice\OutgoingInvoiceImage  $outgoingInvoiceImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOutgoingInvoiceImageRequest $request, OutgoingInvoiceImage $outgoingInvoiceImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OutgoingInvoice\OutgoingInvoiceImage  $outgoingInvoiceImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(OutgoingInvoiceImage $outgoingInvoiceImage)
    {
        Storage::delete("public/" . $outgoingInvoiceImage["image"]);
        $outgoingInvoiceImage->delete();

        return Redirect::back();
    }
}
