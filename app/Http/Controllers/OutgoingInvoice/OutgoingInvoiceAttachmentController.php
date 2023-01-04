<?php

namespace App\Http\Controllers\OutgoingInvoice;

use App\Http\Controllers\Controller;
use App\Models\OutgoingInvoice\OutgoingInvoiceAttachment;
use App\Http\Requests\OutgoingInvoice\StoreOutgoingInvoiceAttachmentRequest;
use App\Http\Requests\OutgoingInvoice\UpdateOutgoingInvoiceAttachmentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class OutgoingInvoiceAttachmentController extends Controller
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
            "attachment" => OutgoingInvoiceAttachment::with('user')->latest()->where('outgoing_invoice_id', $file)->when(Request::input('search'), function ($query, $search) {
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
     * @param  \App\Http\Requests\StoreOutgoingInvoiceAttachmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOutgoingInvoiceAttachmentRequest $request)
    {
        $attachment_path = $request["attachment"]->store('attachment/outgoing_invoice', 'public');
        OutgoingInvoiceAttachment::create([
            'attachment' =>  $attachment_path,
            'outgoing_invoice_id' => $request->id,
            'title' => $request->title,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OutgoingInvoiceAttachment  $outgoingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(OutgoingInvoiceAttachment $outgoingInvoiceAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OutgoingInvoiceAttachment  $outgoingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(OutgoingInvoiceAttachment $outgoingInvoiceAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOutgoingInvoiceAttachmentRequest  $request
     * @param  \App\Models\OutgoingInvoiceAttachment  $outgoingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOutgoingInvoiceAttachmentRequest $request, OutgoingInvoiceAttachment $outgoingInvoiceAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OutgoingInvoiceAttachment  $outgoingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(OutgoingInvoiceAttachment $outgoingInvoiceAttachment)
    {
        Storage::delete("public/" . $outgoingInvoiceAttachment["attachment"]);
        $outgoingInvoiceAttachment->delete();

        return Redirect::back();
    }
}
