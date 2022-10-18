<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\DestructibleGoodsAction;
use App\Http\Requests\Product\StoreDestructibleGoodsActionRequest;
use App\Http\Requests\Product\UpdateDestructibleGoodsActionRequest;

class DestructibleGoodsActionController extends Controller
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
     * @param  \App\Http\Requests\StoreDestructibleGoodsActionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDestructibleGoodsActionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product\DestructibleGoodsAction  $destructibleGoodsAction
     * @return \Illuminate\Http\Response
     */
    public function show(DestructibleGoodsAction $destructibleGoodsAction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product\DestructibleGoodsAction  $destructibleGoodsAction
     * @return \Illuminate\Http\Response
     */
    public function edit(DestructibleGoodsAction $destructibleGoodsAction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDestructibleGoodsActionRequest  $request
     * @param  \App\Models\Product\DestructibleGoodsAction  $destructibleGoodsAction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDestructibleGoodsActionRequest $request, DestructibleGoodsAction $destructibleGoodsAction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product\DestructibleGoodsAction  $destructibleGoodsAction
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestructibleGoodsAction $destructibleGoodsAction)
    {
        //
    }
}
