<?php

namespace App\Http\Controllers\Kit;

use App\Http\Controllers\Controller;
use App\Models\Kit\KitImage;
use App\Http\Requests\Kit\StoreKitImageRequest;
use App\Http\Requests\Kit\UpdateKitImageRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class KitImageController extends Controller
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
     * @param  \App\Http\Requests\StoreKitImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKitImageRequest $request)
    {
        $attachment_path = $request["image"]->store('image/kits', 'public');
        KitImage::create([
            'image' =>  $attachment_path,
            'kit_id' => $request->kit_id,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KitImage  $kitImage
     * @return \Illuminate\Http\Response
     */
    public function show(KitImage $kitImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KitImage  $kitImage
     * @return \Illuminate\Http\Response
     */
    public function edit(KitImage $kitImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKitImageRequest  $request
     * @param  \App\Models\KitImage  $kitImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKitImageRequest $request, KitImage $kitImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KitImage  $kitImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(KitImage $kitImage)
    {
        $kitImage::destroy($kitImage->id);
        Storage::delete("public/" . $kitImage["image"]);
        return Redirect::back();
    }
}
