<?php

namespace App\Http\Controllers;

use App\Models\KitNote;
use App\Http\Requests\StoreKitNoteRequest;
use App\Http\Requests\UpdateKitNoteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class KitNoteController extends Controller
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
     * @param  \App\Http\Requests\StoreKitNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKitNoteRequest $request)
    {
        $note = KitNote::create([
            'note' => $request->note,
            'kit_id' => $request->kit_id,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KitNote  $kitNote
     * @return \Illuminate\Http\Response
     */
    public function show(KitNote $kitNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KitNote  $kitNote
     * @return \Illuminate\Http\Response
     */
    public function edit(KitNote $kitNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKitNoteRequest  $request
     * @param  \App\Models\KitNote  $kitNote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKitNoteRequest $request, KitNote $kitNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KitNote  $kitNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(KitNote $kitNote)
    {
        $kitNote::destroy($kitNote->id);
        return Redirect::back();
    }
}
