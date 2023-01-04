<?php

namespace App\Http\Controllers\OutgoingInvoice;

use App\Http\Controllers\Controller;
use App\Models\OutgoingInvoice\OutgoingInvoiceNote;
use App\Http\Requests\OutgoingInvoice\StoreOutgoingInvoiceNoteRequest;
use App\Http\Requests\OutgoingInvoice\UpdateOutgoingInvoiceNoteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;


class OutgoingInvoiceNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $note = Request::input('id');
        $search = Request::input('search');
        return [
            "note" => OutgoingInvoiceNote::with('user')->latest()->where('outgoing_invoice_id', $note)->when(Request::input('search'), function ($query, $search) {
                $query->where('tag', 'like', "%{$search}%")
                    ->orWhere('note', 'like', "%{$search}%");
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
     * @param  \App\Http\Requests\StoreOutgoingInvoiceNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOutgoingInvoiceNoteRequest $request)
    {
        OutgoingInvoiceNote::create([
            'note' => $request->note,
            'outgoing_invoice_id' => $request->id,
            'tag' => $request->tag,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OutgoingInvoice\OutgoingInvoiceNote  $outgoingInvoiceNote
     * @return \Illuminate\Http\Response
     */
    public function show(OutgoingInvoiceNote $outgoingInvoiceNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OutgoingInvoice\OutgoingInvoiceNote  $outgoingInvoiceNote
     * @return \Illuminate\Http\Response
     */
    public function edit(OutgoingInvoiceNote $outgoingInvoiceNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOutgoingInvoiceNoteRequest  $request
     * @param  \App\Models\OutgoingInvoice\OutgoingInvoiceNote  $outgoingInvoiceNote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOutgoingInvoiceNoteRequest $request, OutgoingInvoiceNote $outgoingInvoiceNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OutgoingInvoice\OutgoingInvoiceNote  $outgoingInvoiceNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(OutgoingInvoiceNote $outgoingInvoiceNote)
    {
        $outgoingInvoiceNote->delete();

        return Redirect::back();
    }
}
