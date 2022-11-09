<?php

namespace App\Http\Controllers\People;

use App\Http\Controllers\Controller;
use App\Models\People\PeopleImage;
use App\Http\Requests\People\StorePeopleImageRequest;
use App\Http\Requests\People\UpdatePeopleImageRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class PeopleImageController extends Controller
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
            "image" => PeopleImage::where('people_id', $image)->with('user')->latest()->paginate()
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
     * @param  \App\Http\Requests\StorePeopleImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePeopleImageRequest $request)
    {
        PeopleImage::create([
            'image' =>  $request["image"]->store('image/peoples', 'public'),
            'people_id' => $request->id,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PeopleImage  $peopleImage
     * @return \Illuminate\Http\Response
     */
    public function show(PeopleImage $peopleImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PeopleImage  $peopleImage
     * @return \Illuminate\Http\Response
     */
    public function edit(PeopleImage $peopleImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePeopleImageRequest  $request
     * @param  \App\Models\PeopleImage  $peopleImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePeopleImageRequest $request, PeopleImage $peopleImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PeopleImage  $peopleImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(PeopleImage $peopleImage)
    {
        Storage::delete("public/" . $peopleImage["image"]);
        $peopleImage->delete();

        return Redirect::back();
    }
}
