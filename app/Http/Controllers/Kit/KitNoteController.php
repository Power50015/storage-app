<?php

namespace App\Http\Controllers\Kit;

use App\Http\Controllers\Controller;
use App\Models\Kit\KitNote;
use App\Http\Requests\Kit\StoreKitNoteRequest;
use App\Http\Requests\Kit\UpdateKitNoteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class KitNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kit = Request::input('id');
        $search = Request::input('search');
        return [
            "note" => KitNote::with('user')->latest()->where('kit_id', $kit)->when(Request::input('search'), function ($query, $search) {
                $query->where('tag', 'like', "%{$search}%")
                    ->orWhere('note', 'like', "%{$search}%");
            })->paginate()->withQueryString(),
            "filters" => $search
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
     * @param  \App\Http\Requests\StoreKitNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKitNoteRequest $request)
    {
        KitNote::create([
            'note' => $request->note,
            'kit_id' => $request->id,
            'tag' => $request->tag,
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
