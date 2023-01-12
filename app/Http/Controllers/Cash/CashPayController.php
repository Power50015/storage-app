<?php

namespace App\Http\Controllers\Cash;

use App\Http\Controllers\Controller;
use App\Models\Cash\CashPay;
use App\Http\Requests\Cash\StoreCashPayRequest;
use App\Http\Requests\Cash\UpdateCashPayRequest;

class CashPayController extends Controller
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
     * @param  \App\Http\Requests\StoreCashPayRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCashPayRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CashPay  $cashPay
     * @return \Illuminate\Http\Response
     */
    public function show(CashPay $cashPay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CashPay  $cashPay
     * @return \Illuminate\Http\Response
     */
    public function edit(CashPay $cashPay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCashPayRequest  $request
     * @param  \App\Models\CashPay  $cashPay
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCashPayRequest $request, CashPay $cashPay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashPay  $cashPay
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashPay $cashPay)
    {
        //
    }
}
