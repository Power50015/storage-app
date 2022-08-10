<?php

namespace App\Http\Controllers;

use App\Models\ProductNote;
use App\Http\Requests\StoreProductNoteRequest;
use App\Http\Requests\UpdateProductNoteRequest;

class ProductNoteController extends Controller
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
     * @param  \App\Http\Requests\StoreProductNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductNoteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductNote  $productNote
     * @return \Illuminate\Http\Response
     */
    public function show(ProductNote $productNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductNote  $productNote
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductNote $productNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductNoteRequest  $request
     * @param  \App\Models\ProductNote  $productNote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductNoteRequest $request, ProductNote $productNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductNote  $productNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductNote $productNote)
    {
        //
    }
}
