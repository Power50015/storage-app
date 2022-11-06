<?php

namespace App\Http\Controllers\Creditor;

use App\Http\Controllers\Controller;
use App\Models\Creditor\CreditorImage;
use App\Http\Requests\Creditor\StoreCreditorImageRequest;
use App\Http\Requests\Creditor\UpdateCreditorImageRequest;

class CreditorImageController extends Controller
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
     * @param  \App\Http\Requests\StoreCreditorImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCreditorImageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CreditorImage  $creditorImage
     * @return \Illuminate\Http\Response
     */
    public function show(CreditorImage $creditorImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CreditorImage  $creditorImage
     * @return \Illuminate\Http\Response
     */
    public function edit(CreditorImage $creditorImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCreditorImageRequest  $request
     * @param  \App\Models\CreditorImage  $creditorImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCreditorImageRequest $request, CreditorImage $creditorImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CreditorImage  $creditorImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(CreditorImage $creditorImage)
    {
        //
    }
}
