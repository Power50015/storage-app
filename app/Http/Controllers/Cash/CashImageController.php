<?php

namespace App\Http\Controllers\Cash;

use App\Http\Controllers\Controller;
use App\Models\Cash\CashImage;
use App\Http\Requests\Cash\StoreCashImageRequest;
use App\Http\Requests\Cash\UpdateCashImageRequest;

class CashImageController extends Controller
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
     * @param  \App\Http\Requests\StoreCashImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCashImageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CashImage  $cashImage
     * @return \Illuminate\Http\Response
     */
    public function show(CashImage $cashImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CashImage  $cashImage
     * @return \Illuminate\Http\Response
     */
    public function edit(CashImage $cashImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCashImageRequest  $request
     * @param  \App\Models\CashImage  $cashImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCashImageRequest $request, CashImage $cashImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashImage  $cashImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashImage $cashImage)
    {
        //
    }
}
