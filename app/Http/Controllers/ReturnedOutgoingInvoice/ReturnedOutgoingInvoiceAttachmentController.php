<?php

namespace App\Http\Controllers\ReturnedOutgoingInvoice;

use App\Http\Controllers\Controller;
use App\Models\ReturnedOutgoingInvoice\ReturnedOutgoingInvoiceAttachment;
use App\Http\Requests\ReturnedOutgoingInvoice\StoreReturnedOutgoingInvoiceAttachmentRequest;
use App\Http\Requests\ReturnedOutgoingInvoice\UpdateReturnedOutgoingInvoiceAttachmentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class ReturnedOutgoingInvoiceAttachmentController extends Controller
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
            "attachment" => ReturnedOutgoingInvoiceAttachment::with('user')->latest()->where('returned_incoming_invoice_id', $file)->when(Request::input('search'), function ($query, $search) {
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
     * @param  \App\Http\Requests\StoreReturnedOutgoingInvoiceAttachmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReturnedOutgoingInvoiceAttachmentRequest $request)
    {
        $attachment_path = $request["attachment"]->store('attachment/returned_incoming_invoice', 'public');
        ReturnedOutgoingInvoiceAttachment::create([
            'attachment' =>  $attachment_path,
            'returned_outgoing_invoice_id' => $request->id,
            'title' => $request->title,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnedOutgoingInvoiceAttachment  $returnedOutgoingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(ReturnedOutgoingInvoiceAttachment $returnedOutgoingInvoiceAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnedOutgoingInvoiceAttachment  $returnedOutgoingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(ReturnedOutgoingInvoiceAttachment $returnedOutgoingInvoiceAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReturnedOutgoingInvoiceAttachmentRequest  $request
     * @param  \App\Models\ReturnedOutgoingInvoiceAttachment  $returnedOutgoingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReturnedOutgoingInvoiceAttachmentRequest $request, ReturnedOutgoingInvoiceAttachment $returnedOutgoingInvoiceAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnedOutgoingInvoiceAttachment  $returnedOutgoingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturnedOutgoingInvoiceAttachment $returnedOutgoingInvoiceAttachment)
    {
        Storage::delete("public/" . $returnedOutgoingInvoiceAttachment["attachment"]);
        $returnedOutgoingInvoiceAttachment->delete();

        return Redirect::back();
    }
}
