<?php

namespace App\Http\Controllers\ReturnedIncomingInvoice;

use App\Http\Controllers\Controller;
use App\Models\ReturnedIncomingInvoice\ReturnedIncomingInvoiceAttachment;
use App\Http\Requests\ReturnedIncomingInvoice\StoreReturnedIncomingInvoiceAttachmentRequest;
use App\Http\Requests\ReturnedIncomingInvoice\UpdateReturnedIncomingInvoiceAttachmentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class ReturnedIncomingInvoiceAttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $file = Request::input('id');
        $search = Request::input('search');
        return [
            "attachment" => ReturnedIncomingInvoiceAttachment::with('user')->latest()->where('returned_incoming_invoice_id', $file)->when(Request::input('search'), function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })->paginate()->withQueryString(),
            "filters" => $search
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
     * @param  \App\Http\Requests\StoreReturnedIncomingInvoiceAttachmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReturnedIncomingInvoiceAttachmentRequest $request)
    {
        $attachment_path = $request["attachment"]->store('attachment/returned_incoming_invoice', 'public');
        ReturnedIncomingInvoiceAttachment::create([
            'attachment' =>  $attachment_path,
            'returned_incoming_invoice_id' => $request->id,
            'title' => $request->title,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnedIncomingInvoiceAttachment  $returnedIncomingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(ReturnedIncomingInvoiceAttachment $returnedIncomingInvoiceAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnedIncomingInvoiceAttachment  $returnedIncomingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(ReturnedIncomingInvoiceAttachment $returnedIncomingInvoiceAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReturnedIncomingInvoiceAttachmentRequest  $request
     * @param  \App\Models\ReturnedIncomingInvoiceAttachment  $returnedIncomingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReturnedIncomingInvoiceAttachmentRequest $request, ReturnedIncomingInvoiceAttachment $returnedIncomingInvoiceAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnedIncomingInvoiceAttachment  $returnedIncomingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturnedIncomingInvoiceAttachment $returnedIncomingInvoiceAttachment)
    {
        Storage::delete("public/" . $returnedIncomingInvoiceAttachment["attachment"]);
        $returnedIncomingInvoiceAttachment->delete();

        return Redirect::back();
    }
}
