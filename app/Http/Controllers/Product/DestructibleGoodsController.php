<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\DestructibleGoods;
use App\Http\Requests\Product\StoreDestructibleGoodsRequest;
use App\Http\Requests\Product\UpdateDestructibleGoodsRequest;

class DestructibleGoodsController extends Controller
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
     * @param  \App\Http\Requests\StoreDestructibleGoodsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDestructibleGoodsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product\DestructibleGoods  $destructibleGoods
     * @return \Illuminate\Http\Response
     */
    public function show(DestructibleGoods $destructibleGoods)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product\DestructibleGoods  $destructibleGoods
     * @return \Illuminate\Http\Response
     */
    public function edit(DestructibleGoods $destructibleGoods)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDestructibleGoodsRequest  $request
     * @param  \App\Models\Product\DestructibleGoods  $destructibleGoods
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDestructibleGoodsRequest $request, DestructibleGoods $destructibleGoods)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product\DestructibleGoods  $destructibleGoods
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestructibleGoods $destructibleGoods)
    {
        //
    }
}