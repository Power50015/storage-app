<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\DestructibleGoodsAction;
use App\Http\Requests\Product\StoreDestructibleGoodsActionRequest;
use App\Http\Requests\Product\UpdateDestructibleGoodsActionRequest;
use App\Models\Product\DestructibleGoods;
use App\Models\Product\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class DestructibleGoodsActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Request::input('product');

        if ($product) {
            $data = DestructibleGoodsAction::where('action', '==', 0)->whereRelation('destructible_goods', 'product_id', $product)->get();

            foreach ($data as $key => $value) {
                if (DestructibleGoodsAction::where('destructible_goods_id', $data[$key]['destructible_goods_id'])->count() == 1) {
                    $row = DestructibleGoodsAction::where('destructible_goods_id', $data[$key]['destructible_goods_id'])->get('id');
                    $ids[] = $row[0]['id'];
                }
            }
            if (isset($ids))
                return ["DestructibleGoodsAction" => DestructibleGoodsAction::with('destructible_goods', 'user', 'destructible_goods.product', 'destructible_goods.warehouse')->whereIn('id',  $ids)->paginate()];
            else return [];
        } else {
            $data = DestructibleGoodsAction::where('action', '==', 0)->get();

            foreach ($data as $key => $value) {
                if (DestructibleGoodsAction::where('destructible_goods_id', $data[$key]['destructible_goods_id'])->count() == 1) {
                    $row = DestructibleGoodsAction::where('destructible_goods_id', $data[$key]['destructible_goods_id'])->get('id');
                    $ids[] = $row[0]['id'];
                }
            }
            return ["DestructibleGoodsAction" => DestructibleGoodsAction::with('destructible_goods', 'user', 'destructible_goods.product', 'destructible_goods.warehouse')->whereIn('id',  $ids)->paginate()];
        }
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
        $destructibleGoods = DestructibleGoods::find($request->destructible_goods_id);

        $product = Product::find($destructibleGoods->product_id);
        $product->destructible =  $product->destructible - 1;
        $product->save();

        DestructibleGoodsAction::create([
            "title" => $request->title,
            "description" => $request->description,
            "action" => $request->action,
            "date" => Carbon::parse($request->date),
            "destructible_goods_id" => $request->destructible_goods_id,
            'user_id' => auth()->user()->id,
        ]);
        return Redirect::back();
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
        $destructibleGoodsAction->title = $request->title;
        $destructibleGoodsAction->description = $request->description;
        $destructibleGoodsAction->action = $request->action;
        $destructibleGoodsAction->date = Carbon::parse($request->date);
        $destructibleGoodsAction->save();
        return Redirect::back();
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
