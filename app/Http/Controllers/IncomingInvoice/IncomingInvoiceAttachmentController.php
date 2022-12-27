<?php

namespace App\Http\Controllers\IncomingInvoice;

use App\Http\Controllers\Controller;
use App\Models\IncomingInvoice\IncomingInvoiceAttachment;
use App\Http\Requests\IncomingInvoice\StoreIncomingInvoiceAttachmentRequest;
use App\Http\Requests\IncomingInvoice\UpdateIncomingInvoiceAttachmentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class IncomingInvoiceAttachmentController extends Controller
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
            "attachment" => IncomingInvoiceAttachment::with('user')->latest()->where('incoming_invoice_id', $file)->when(Request::input('search'), function ($query, $search) {
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
     * @param  \App\Http\Requests\StoreIncomingInvoiceAttachmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIncomingInvoiceAttachmentRequest $request)
    {
        $attachment_path = $request["attachment"]->store('attachment/incoming_invoice', 'public');
        IncomingInvoiceAttachment::create([
            'attachment' =>  $attachment_path,
            'incoming_invoice_id' => $request->id,
            'title' => $request->title,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IncomingInvoiceAttachment  $incomingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(IncomingInvoiceAttachment $incomingInvoiceAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IncomingInvoiceAttachment  $incomingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(IncomingInvoiceAttachment $incomingInvoiceAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIncomingInvoiceAttachmentRequest  $request
     * @param  \App\Models\IncomingInvoiceAttachment  $incomingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIncomingInvoiceAttachmentRequest $request, IncomingInvoiceAttachment $incomingInvoiceAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IncomingInvoiceAttachment  $incomingInvoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(IncomingInvoiceAttachment $incomingInvoiceAttachment)
    {
        Storage::delete("public/" . $incomingInvoiceAttachment["attachment"]);
        $incomingInvoiceAttachment->delete();

        return Redirect::back();
    }
}
