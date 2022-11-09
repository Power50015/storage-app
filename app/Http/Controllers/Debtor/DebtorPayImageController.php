<?php

namespace App\Http\Controllers\Debtor;

use App\Http\Controllers\Controller;
use App\Models\Debtor\DebtorPayImage;
use App\Http\Requests\Debtor\StoreDebtorPayImageRequest;
use App\Http\Requests\Debtor\UpdateDebtorPayImageRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class DebtorPayImageController extends Controller
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
            "image" => DebtorPayImage::where('debtor_pay_id', $image)->with('user')->latest()->paginate()
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
     * @param  \App\Http\Requests\StoreDebtorPayImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDebtorPayImageRequest $request)
    {
        DebtorPayImage::create([
            'image' =>  $request["image"]->store('image/debtor_pays', 'public'),
            'debtor_pay_id' => $request->id,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DebtorPayImage  $debtorPayImage
     * @return \Illuminate\Http\Response
     */
    public function show(DebtorPayImage $debtorPayImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DebtorPayImage  $debtorPayImage
     * @return \Illuminate\Http\Response
     */
    public function edit(DebtorPayImage $debtorPayImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDebtorPayImageRequest  $request
     * @param  \App\Models\DebtorPayImage  $debtorPayImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDebtorPayImageRequest $request, DebtorPayImage $debtorPayImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DebtorPayImage  $debtorPayImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(DebtorPayImage $debtorPayImage)
    {
        Storage::delete("public/" . $debtorPayImage["image"]);
        $debtorPayImage->delete();

        return Redirect::back();
    }
}
