<?php

namespace App\Http\Controllers\Kit;

use App\Http\Controllers\Controller;
use App\Models\Kit\KitImage;
use App\Http\Requests\Kit\StoreKitImageRequest;
use App\Http\Requests\Kit\UpdateKitImageRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Request;


class KitImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kit = Request::input('id');
        return [
            "image" => KitImage::where('kit_id', $kit)->with('user')->latest()->paginate()
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
     * @param  \App\Http\Requests\StoreKitImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKitImageRequest $request)
    {
        KitImage::create([
            'image' =>  $request["image"]->store('image/kits', 'public'),
            'kit_id' => $request->id,
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
        Storage::delete("public/" . $kitImage["image"]);
        $kitImage->delete();

        return Redirect::back();
    }
}
