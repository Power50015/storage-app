<?php

namespace App\Http\Controllers\Creditor;

use App\Http\Controllers\Controller;
use App\Models\Creditor\CreditorPayImage;
use App\Http\Requests\Creditor\StoreCreditorPayImageRequest;
use App\Http\Requests\Creditor\UpdateCreditorPayImageRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class CreditorPayImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Request::input('id');
        return [
            "image" => CreditorPayImage::where('creditor_pay_id', $id)->with('user')->latest()->paginate()
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
     * @param  \App\Http\Requests\StoreCreditorPayImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCreditorPayImageRequest $request)
    {
        CreditorPayImage::create([
            'image' =>  $request["image"]->store('image/creditor_pays', 'public'),
            'creditor_pay_id' => $request->id,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CreditorPayImage  $creditorPayImage
     * @return \Illuminate\Http\Response
     */
    public function show(CreditorPayImage $creditorPayImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CreditorPayImage  $creditorPayImage
     * @return \Illuminate\Http\Response
     */
    public function edit(CreditorPayImage $creditorPayImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCreditorPayImageRequest  $request
     * @param  \App\Models\CreditorPayImage  $creditorPayImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCreditorPayImageRequest $request, CreditorPayImage $creditorPayImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CreditorPayImage  $creditorPayImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(CreditorPayImage $creditorPayImage)
    {
        Storage::delete("public/" . $creditorPayImage["image"]);
        $creditorPayImage->delete();

        return Redirect::back();
    }
}
