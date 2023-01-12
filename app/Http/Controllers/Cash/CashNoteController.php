<?php

namespace App\Http\Controllers\Cash;

use App\Http\Controllers\Controller;
use App\Models\Cash\CashNote;
use App\Http\Requests\CashStoreCashNoteRequest;
use App\Http\Requests\CashUpdateCashNoteRequest;

class CashNoteController extends Controller
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
     * @param  \App\Http\Requests\StoreCashNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCashNoteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CashNote  $cashNote
     * @return \Illuminate\Http\Response
     */
    public function show(CashNote $cashNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CashNote  $cashNote
     * @return \Illuminate\Http\Response
     */
    public function edit(CashNote $cashNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCashNoteRequest  $request
     * @param  \App\Models\CashNote  $cashNote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCashNoteRequest $request, CashNote $cashNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashNote  $cashNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashNote $cashNote)
    {
        //
    }
}
