<?php

namespace App\Http\Controllers;

use App\Models\KitImage;
use App\Http\Requests\StoreKitImageRequest;
use App\Http\Requests\UpdateKitImageRequest;

class KitImageController extends Controller
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
     * @param  \App\Http\Requests\StoreKitImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKitImageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KitImage  $kitImage
     * @return \Illuminate\Http\Response
     */
    public function show(KitImage $kitImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KitImage  $kitImage
     * @return \Illuminate\Http\Response
     */
    public function edit(KitImage $kitImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKitImageRequest  $request
     * @param  \App\Models\KitImage  $kitImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKitImageRequest $request, KitImage $kitImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KitImage  $kitImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(KitImage $kitImage)
    {
        //
    }
}
