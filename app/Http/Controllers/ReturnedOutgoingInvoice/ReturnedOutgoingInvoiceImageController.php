<?php

namespace App\Http\Controllers\ReturnedOutgoingInvoice;

use App\Http\Controllers\Controller;
use App\Models\ReturnedOutgoingInvoice\ReturnedOutgoingInvoiceImage;
use App\Http\Requests\ReturnedOutgoingInvoice\StoreReturnedOutgoingInvoiceImageRequest;
use App\Http\Requests\ReturnedOutgoingInvoice\UpdateReturnedOutgoingInvoiceImageRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Request;

class ReturnedOutgoingInvoiceImageController extends Controller
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
            "image" => ReturnedOutgoingInvoiceImage::where('returned_outgoing_invoice_id', $image)->with('user')->latest()->paginate()
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
     * @param  \App\Http\Requests\StoreReturnedOutgoingInvoiceImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReturnedOutgoingInvoiceImageRequest $request)
    {
        ReturnedOutgoingInvoiceImage::create([
            'image' =>  $request["image"]->store('image/returned_outgoing_invoice', 'public'),
            'returned_outgoing_invoice_id' => $request->id,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnedOutgoingInvoiceImage  $ReturnedOutgoingInvoiceImage
     * @return \Illuminate\Http\Response
     */
    public function show(ReturnedOutgoingInvoiceImage $ReturnedOutgoingInvoiceImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnedOutgoingInvoiceImage  $ReturnedOutgoingInvoiceImage
     * @return \Illuminate\Http\Response
     */
    public function edit(ReturnedOutgoingInvoiceImage $ReturnedOutgoingInvoiceImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReturnedOutgoingInvoiceImageRequest  $request
     * @param  \App\Models\ReturnedOutgoingInvoiceImage  $ReturnedOutgoingInvoiceImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReturnedOutgoingInvoiceImageRequest $request, ReturnedOutgoingInvoiceImage $ReturnedOutgoingInvoiceImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnedOutgoingInvoiceImage  $ReturnedOutgoingInvoiceImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturnedOutgoingInvoiceImage $ReturnedOutgoingInvoiceImage)
    {
        Storage::delete("public/" . $ReturnedOutgoingInvoiceImage["image"]);
        $ReturnedOutgoingInvoiceImage->delete();

        return Redirect::back();
    }
}
