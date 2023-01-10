<?php

namespace App\Http\Controllers\ReturnedIncomingInvoice;

use App\Http\Controllers\Controller;

use App\Models\ReturnedIncomingInvoice\ReturnedIncomingInvoiceImage;
use App\Http\Requests\ReturnedIncomingInvoice\StoreReturnedIncomingInvoiceImageRequest;
use App\Http\Requests\ReturnedIncomingInvoice\UpdateReturnedIncomingInvoiceImageRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Request;

class ReturnedIncomingInvoiceImageController extends Controller
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
            "image" => ReturnedIncomingInvoiceImage::where('returned_incoming_invoice_id', $image)->with('user')->latest()->paginate()
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
     * @param  \App\Http\Requests\StoreReturnedIncomingInvoiceImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReturnedIncomingInvoiceImageRequest $request)
    {
        ReturnedIncomingInvoiceImage::create([
            'image' =>  $request["image"]->store('image/returned_incoming_invoice', 'public'),
            'returned_incoming_invoice_id' => $request->id,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnedIncomingInvoiceImage  $returnedIncomingInvoiceImage
     * @return \Illuminate\Http\Response
     */
    public function show(ReturnedIncomingInvoiceImage $returnedIncomingInvoiceImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnedIncomingInvoiceImage  $returnedIncomingInvoiceImage
     * @return \Illuminate\Http\Response
     */
    public function edit(ReturnedIncomingInvoiceImage $returnedIncomingInvoiceImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReturnedIncomingInvoiceImageRequest  $request
     * @param  \App\Models\ReturnedIncomingInvoiceImage  $returnedIncomingInvoiceImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReturnedIncomingInvoiceImageRequest $request, ReturnedIncomingInvoiceImage $returnedIncomingInvoiceImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnedIncomingInvoiceImage  $returnedIncomingInvoiceImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturnedIncomingInvoiceImage $returnedIncomingInvoiceImage)
    {
        Storage::delete("public/" . $returnedIncomingInvoiceImage["image"]);
        $returnedIncomingInvoiceImage->delete();

        return Redirect::back();
    }
}
