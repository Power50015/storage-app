<?php

namespace App\Http\Controllers\Kit;


use App\Http\Controllers\Controller;
use App\Models\Kit\KitOperation;
use App\Http\Requests\Kit\StoreKitOperationRequest;
use App\Http\Requests\Kit\UpdateKitOperationRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class KitOperationController extends Controller
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
     * @param  \App\Http\Requests\StoreKitOperationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKitOperationRequest $request)
    {
        $kit = KitOperation::create(
            [
                'title' => $request->title,
                'action' => $request->action,
                'kit_id' => $request->kit_id,
                'user_id' => auth()->user()->id,
                'warehouse_id' => $request->warehouse_id,
                'quantity' => $request->quantity,
                'date' => Carbon::parse($request->date),
            ]
        );
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KitOperation  $kitOperation
     * @return \Illuminate\Http\Response
     */
    public function show(KitOperation $kitOperation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KitOperation  $kitOperation
     * @return \Illuminate\Http\Response
     */
    public function edit(KitOperation $kitOperation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKitOperationRequest  $request
     * @param  \App\Models\KitOperation  $kitOperation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKitOperationRequest $request, KitOperation $kitOperation)
    {
        $kitOperation->title = $request->title;
        $kitOperation->action = $request->action;
        $kitOperation->quantity = $request->quantity;
        $kitOperation->date = Carbon::parse($request->date);
        $kitOperation->save();
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KitOperation  $kitOperation
     * @return \Illuminate\Http\Response
     */
    public function destroy(KitOperation $kitOperation)
    {
        $kitOperation->delete();
        return Redirect::back();
    }
}
