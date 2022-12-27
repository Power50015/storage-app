<?php

namespace App\Http\Controllers\IncomingInvoice;

use App\Http\Controllers\Controller;
use App\Models\IncomingInvoice\IncomingInvoiceNote;
use App\Http\Requests\IncomingInvoice\StoreIncomingInvoiceNoteRequest;
use App\Http\Requests\IncomingInvoice\UpdateIncomingInvoiceNoteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;


class IncomingInvoiceNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $note = Request::input('id');
        $search = Request::input('search');
        return [
            "note" => IncomingInvoiceNote::with('user')->latest()->where('incoming_invoice_id', $note)->when(Request::input('search'), function ($query, $search) {
                $query->where('tag', 'like', "%{$search}%")
                    ->orWhere('note', 'like', "%{$search}%");
            })->paginate()->withQueryString(),
            "filters" => $search
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIncomingInvoiceNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIncomingInvoiceNoteRequest $request)
    {
        IncomingInvoiceNote::create([
            'note' => $request->note,
            'incoming_invoice_id' => $request->id,
            'tag' => $request->tag,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IncomingInvoiceNote  $incomingInvoiceNote
     * @return \Illuminate\Http\Response
     */
    public function show(IncomingInvoiceNote $incomingInvoiceNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IncomingInvoiceNote  $incomingInvoiceNote
     * @return \Illuminate\Http\Response
     */
    public function edit(IncomingInvoiceNote $incomingInvoiceNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIncomingInvoiceNoteRequest  $request
     * @param  \App\Models\IncomingInvoiceNote  $incomingInvoiceNote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIncomingInvoiceNoteRequest $request, IncomingInvoiceNote $incomingInvoiceNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IncomingInvoiceNote  $incomingInvoiceNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(IncomingInvoiceNote $incomingInvoiceNote)
    {
        $incomingInvoiceNote->delete();

        return Redirect::back();
    }
}
