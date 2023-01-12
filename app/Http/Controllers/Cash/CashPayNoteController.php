<?php

namespace App\Http\Controllers\Cash;

use App\Http\Controllers\Controller;
use App\Models\Cash\CashPayNote;
use App\Http\Requests\Cash\StoreCashPayNoteRequest;
use App\Http\Requests\Cash\UpdateCashPayNoteRequest;

class CashPayNoteController extends Controller
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
     * @param  \App\Http\Requests\StoreCashPayNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCashPayNoteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CashPayNote  $cashPayNote
     * @return \Illuminate\Http\Response
     */
    public function show(CashPayNote $cashPayNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CashPayNote  $cashPayNote
     * @return \Illuminate\Http\Response
     */
    public function edit(CashPayNote $cashPayNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCashPayNoteRequest  $request
     * @param  \App\Models\CashPayNote  $cashPayNote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCashPayNoteRequest $request, CashPayNote $cashPayNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashPayNote  $cashPayNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashPayNote $cashPayNote)
    {
        //
    }
}
