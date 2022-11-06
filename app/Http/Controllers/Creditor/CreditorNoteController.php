<?php

namespace App\Http\Controllers\Creditor;

use App\Http\Controllers\Controller;
use App\Models\Creditor\CreditorNote;
use App\Http\Requests\Creditor\StoreCreditorNoteRequest;
use App\Http\Requests\Creditor\UpdateCreditorNoteRequest;

class CreditorNoteController extends Controller
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
     * @param  \App\Http\Requests\StoreCreditorNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCreditorNoteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CreditorNote  $creditorNote
     * @return \Illuminate\Http\Response
     */
    public function show(CreditorNote $creditorNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CreditorNote  $creditorNote
     * @return \Illuminate\Http\Response
     */
    public function edit(CreditorNote $creditorNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCreditorNoteRequest  $request
     * @param  \App\Models\CreditorNote  $creditorNote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCreditorNoteRequest $request, CreditorNote $creditorNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CreditorNote  $creditorNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(CreditorNote $creditorNote)
    {
        //
    }
}
