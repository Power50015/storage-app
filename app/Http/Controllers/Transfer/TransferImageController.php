<?php

namespace App\Http\Controllers\Transfer;


use App\Http\Controllers\Controller;
use App\Models\Transfer\TransferImage;
use App\Http\Requests\Transfer\StoreTransferImageRequest;
use App\Http\Requests\Transfer\UpdateTransferImageRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;


class TransferImageController extends Controller
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
            "image" => TransferImage::where('transfer_id', $image)->with('user')->latest()->paginate()
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
     * @param  \App\Http\Requests\StoreTransferImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransferImageRequest $request)
    {
        TransferImage::create([
            'image' =>  $request["image"]->store('image/transfer', 'public'),
            'transfer_id' => $request->id,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransferImage  $transferImage
     * @return \Illuminate\Http\Response
     */
    public function show(TransferImage $transferImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransferImage  $transferImage
     * @return \Illuminate\Http\Response
     */
    public function edit(TransferImage $transferImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransferImageRequest  $request
     * @param  \App\Models\TransferImage  $transferImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransferImageRequest $request, TransferImage $transferImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransferImage  $transferImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransferImage $transferImage)
    {
        Storage::delete("public/" . $transferImage["image"]);
        $transferImage->delete();

        return Redirect::back();
    }
}
