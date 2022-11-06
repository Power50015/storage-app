<?php

namespace App\Http\Controllers\Creditor;

use App\Http\Controllers\Controller;
use App\Models\Creditor\CreditorPayNote;
use App\Http\Requests\Creditor\StoreCreditorPayNoteRequest;
use App\Http\Requests\Creditor\UpdateCreditorPayNoteRequest;

class CreditorPayNoteController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCreditorPayNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCreditorPayNoteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CreditorPayNote  $creditorPayNote
     * @return \Illuminate\Http\Response
     */
    public function show(CreditorPayNote $creditorPayNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CreditorPayNote  $creditorPayNote
     * @return \Illuminate\Http\Response
     */
    public function edit(CreditorPayNote $creditorPayNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCreditorPayNoteRequest  $request
     * @param  \App\Models\CreditorPayNote  $creditorPayNote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCreditorPayNoteRequest $request, CreditorPayNote $creditorPayNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CreditorPayNote  $creditorPayNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(CreditorPayNote $creditorPayNote)
    {
        //
    }
}
