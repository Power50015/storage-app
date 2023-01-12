<?php

namespace App\Http\Controllers\ReturnedOutgoingInvoice;

use App\Http\Controllers\Controller;
use App\Models\ReturnedOutgoingInvoice\ReturnedOutgoingInvoiceNote;
use App\Http\Requests\ReturnedOutgoingInvoice\StoreReturnedOutgoingInvoiceNoteRequest;
use App\Http\Requests\ReturnedOutgoingInvoice\UpdateReturnedOutgoingInvoiceNoteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class ReturnedOutgoingInvoiceNoteController extends Controller
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
            "note" => ReturnedOutgoingInvoiceNote::with('user')->latest()->where('returned_outgoing_invoice_id', $note)->when(Request::input('search'), function ($query, $search) {
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
     * @param  \App\Http\Requests\StoreReturnedOutgoingInvoiceNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReturnedOutgoingInvoiceNoteRequest $request)
    {
        ReturnedOutgoingInvoiceNote::create([
            'note' => $request->note,
            'returned_outgoing_invoice_id' => $request->id,
            'tag' => $request->tag,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnedOutgoingInvoiceNote  $returnedOutgoingInvoiceNote
     * @return \Illuminate\Http\Response
     */
    public function show(ReturnedOutgoingInvoiceNote $returnedOutgoingInvoiceNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnedOutgoingInvoiceNote  $returnedOutgoingInvoiceNote
     * @return \Illuminate\Http\Response
     */
    public function edit(ReturnedOutgoingInvoiceNote $returnedOutgoingInvoiceNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReturnedOutgoingInvoiceNoteRequest  $request
     * @param  \App\Models\ReturnedOutgoingInvoiceNote  $returnedOutgoingInvoiceNote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReturnedOutgoingInvoiceNoteRequest $request, ReturnedOutgoingInvoiceNote $returnedOutgoingInvoiceNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnedOutgoingInvoiceNote  $returnedOutgoingInvoiceNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturnedOutgoingInvoiceNote $returnedOutgoingInvoiceNote)
    {
        $returnedOutgoingInvoiceNote->delete();

        return Redirect::back();
    }
}
