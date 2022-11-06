<?php

namespace App\Http\Controllers\Creditor;

use App\Http\Controllers\Controller;
use App\Models\Creditor\CreditorPayImage;
use App\Http\Requests\Creditor\StoreCreditorPayImageRequest;
use App\Http\Requests\Creditor\UpdateCreditorPayImageRequest;

class CreditorPayImageController extends Controller
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
     * @param  \App\Http\Requests\StoreCreditorPayImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCreditorPayImageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CreditorPayImage  $creditorPayImage
     * @return \Illuminate\Http\Response
     */
    public function show(CreditorPayImage $creditorPayImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CreditorPayImage  $creditorPayImage
     * @return \Illuminate\Http\Response
     */
    public function edit(CreditorPayImage $creditorPayImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCreditorPayImageRequest  $request
     * @param  \App\Models\CreditorPayImage  $creditorPayImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCreditorPayImageRequest $request, CreditorPayImage $creditorPayImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CreditorPayImage  $creditorPayImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(CreditorPayImage $creditorPayImage)
    {
        //
    }
}
