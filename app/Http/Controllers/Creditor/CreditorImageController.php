<?php

namespace App\Http\Controllers\Creditor;

use App\Http\Controllers\Controller;
use App\Models\Creditor\CreditorImage;
use App\Http\Requests\Creditor\StoreCreditorImageRequest;
use App\Http\Requests\Creditor\UpdateCreditorImageRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class CreditorImageController extends Controller
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
            "image" => CreditorImage::where('creditor_id', $id)->with('user')->latest()->paginate()
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
     * @param  \App\Http\Requests\StoreCreditorImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCreditorImageRequest $request)
    {
        CreditorImage::create([
            'image' =>  $request["image"]->store('image/creditors', 'public'),
            'creditor_id' => $request->id,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CreditorImage  $creditorImage
     * @return \Illuminate\Http\Response
     */
    public function show(CreditorImage $creditorImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CreditorImage  $creditorImage
     * @return \Illuminate\Http\Response
     */
    public function edit(CreditorImage $creditorImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCreditorImageRequest  $request
     * @param  \App\Models\CreditorImage  $creditorImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCreditorImageRequest $request, CreditorImage $creditorImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CreditorImage  $creditorImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(CreditorImage $creditorImage)
    {
        Storage::delete("public/" . $creditorImage["image"]);
        $creditorImage->delete();

        return Redirect::back();
    }
}
