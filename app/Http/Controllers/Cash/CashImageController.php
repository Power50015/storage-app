<?php

namespace App\Http\Controllers\Cash;

use App\Http\Controllers\Controller;
use App\Models\Cash\CashImage;
use App\Http\Requests\Cash\StoreCashImageRequest;
use App\Http\Requests\Cash\UpdateCashImageRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class CashImageController extends Controller
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
            "image" => CashImage::where('cash_id', $image)->with('user')->latest()->paginate()
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
     * @param  \App\Http\Requests\StoreCashImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCashImageRequest $request)
    {
        CashImage::create([
            'image' =>  $request["image"]->store('image/cash', 'public'),
            'cash_id' => $request->id,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
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
        Storage::delete("public/" . $cashImage["image"]);
        $cashImage->delete();

        return Redirect::back();
    }
}
