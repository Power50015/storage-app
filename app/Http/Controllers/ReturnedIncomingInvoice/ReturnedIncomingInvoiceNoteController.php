<?php

namespace App\Http\Controllers\ReturnedIncomingInvoice;

use App\Http\Controllers\Controller;
use App\Models\ReturnedIncomingInvoice\ReturnedIncomingInvoiceNote;
use App\Http\Requests\ReturnedIncomingInvoice\StoreReturnedIncomingInvoiceNoteRequest;
use App\Http\Requests\ReturnedIncomingInvoice\UpdateReturnedIncomingInvoiceNoteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class ReturnedIncomingInvoiceNoteController extends Controller
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
            "note" => ReturnedIncomingInvoiceNote::with('user')->latest()->where('returned_incoming_invoice_id', $note)->when(Request::input('search'), function ($query, $search) {
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
     * @param  \App\Http\Requests\StoreReturnedIncomingInvoiceNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReturnedIncomingInvoiceNoteRequest $request)
    {
        ReturnedIncomingInvoiceNote::create([
            'note' => $request->note,
            'returned_incoming_invoice_id' => $request->id,
            'tag' => $request->tag,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnedIncomingInvoiceNote  $returnedIncomingInvoiceNote
     * @return \Illuminate\Http\Response
     */
    public function show(ReturnedIncomingInvoiceNote $returnedIncomingInvoiceNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnedIncomingInvoiceNote  $returnedIncomingInvoiceNote
     * @return \Illuminate\Http\Response
     */
    public function edit(ReturnedIncomingInvoiceNote $returnedIncomingInvoiceNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReturnedIncomingInvoiceNoteRequest  $request
     * @param  \App\Models\ReturnedIncomingInvoiceNote  $returnedIncomingInvoiceNote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReturnedIncomingInvoiceNoteRequest $request, ReturnedIncomingInvoiceNote $returnedIncomingInvoiceNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnedIncomingInvoiceNote  $returnedIncomingInvoiceNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturnedIncomingInvoiceNote $returnedIncomingInvoiceNote)
    {
        $returnedIncomingInvoiceNote->delete();

        return Redirect::back();
    }
}
