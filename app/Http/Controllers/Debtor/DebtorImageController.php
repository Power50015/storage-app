<?php

namespace App\Http\Controllers\Debtor;

use App\Http\Controllers\Controller;
use App\Models\Debtor\DebtorImage;
use App\Http\Requests\Debtor\StoreDebtorImageRequest;
use App\Http\Requests\Debtor\UpdateDebtorImageRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class DebtorImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $debtor = Request::input('id');
        return [
            "image" => DebtorImage::where('debtor_id', $debtor)->with('user')->latest()->paginate()
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
     * @param  \App\Http\Requests\StoreDebtorImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDebtorImageRequest $request)
    {
        DebtorImage::create([
            'image' =>  $request["image"]->store('image/debtors', 'public'),
            'debtor_id' => $request->id,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DebtorImage  $debtorImage
     * @return \Illuminate\Http\Response
     */
    public function show(DebtorImage $debtorImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DebtorImage  $debtorImage
     * @return \Illuminate\Http\Response
     */
    public function edit(DebtorImage $debtorImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDebtorImageRequest  $request
     * @param  \App\Models\DebtorImage  $debtorImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDebtorImageRequest $request, DebtorImage $debtorImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DebtorImage  $debtorImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(DebtorImage $debtorImage)
    {
        Storage::delete("public/" . $debtorImage["image"]);
        $debtorImage->delete();

        return Redirect::back();
    }
}
