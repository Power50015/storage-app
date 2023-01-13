<?php

namespace App\Http\Controllers\Cash;

use App\Http\Controllers\Controller;
use App\Models\Cash\CashPayImage;
use App\Http\Requests\Cash\StoreCashPayImageRequest;
use App\Http\Requests\Cash\UpdateCashPayImageRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class CashPayImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $image = Request::input('id');
        return [
            "image" => CashPayImage::where('cash_pay_id', $image)->with('user')->latest()->paginate()
        ];
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
     * @param  \App\Http\Requests\StoreCashPayImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCashPayImageRequest $request)
    {
        CashPayImage::create([
            'image' =>  $request["image"]->store('image/cash_pay', 'public'),
            'cash_pay_id' => $request->id,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CashPayImage  $cashPayImage
     * @return \Illuminate\Http\Response
     */
    public function show(CashPayImage $cashPayImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CashPayImage  $cashPayImage
     * @return \Illuminate\Http\Response
     */
    public function edit(CashPayImage $cashPayImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCashPayImageRequest  $request
     * @param  \App\Models\CashPayImage  $cashPayImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCashPayImageRequest $request, CashPayImage $cashPayImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashPayImage  $cashPayImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashPayImage $cashPayImage)
    {
        Storage::delete("public/" . $cashPayImage["image"]);
        $cashPayImage->delete();

        return Redirect::back();
    }
}
