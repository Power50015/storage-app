<?php

namespace App\Http\Controllers\People;

use App\Http\Controllers\Controller;
use App\Models\People\PeopleNote;
use App\Http\Requests\People\StorePeopleNoteRequest;
use App\Http\Requests\People\UpdatePeopleNoteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class PeopleNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $note = Request::input('id');
        $search = Request::input('search');
        return [
            "note" => PeopleNote::with('user')->latest()->where('people_id', $note)->when(Request::input('search'), function ($query, $search) {
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
     * @param  \App\Http\Requests\StorePeopleNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePeopleNoteRequest $request)
    {
        PeopleNote::create([
            'note' => $request->note,
            'people_id' => $request->id,
            'tag' => $request->tag,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PeopleNote  $peopleNote
     * @return \Illuminate\Http\Response
     */
    public function show(PeopleNote $peopleNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PeopleNote  $peopleNote
     * @return \Illuminate\Http\Response
     */
    public function edit(PeopleNote $peopleNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePeopleNoteRequest  $request
     * @param  \App\Models\PeopleNote  $peopleNote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePeopleNoteRequest $request, PeopleNote $peopleNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PeopleNote  $peopleNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(PeopleNote $peopleNote)
    {
        $peopleNote->delete();

        return Redirect::back();
    }
}
