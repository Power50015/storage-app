<?php

namespace App\Http\Controllers\Creditor;

use App\Http\Controllers\Controller;
use App\Models\Creditor\CreditorNote;
use App\Http\Requests\Creditor\StoreCreditorNoteRequest;
use App\Http\Requests\Creditor\UpdateCreditorNoteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class CreditorNoteController extends Controller
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
            "note" => CreditorNote::with('user')->latest()->where('creditor_id', $note)->when(Request::input('search'), function ($query, $search) {
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
     * @param  \App\Http\Requests\StoreCreditorNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCreditorNoteRequest $request)
    {
        CreditorNote::create([
            'note' => $request->note,
            'creditor_id' => $request->id,
            'tag' => $request->tag,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CreditorNote  $creditorNote
     * @return \Illuminate\Http\Response
     */
    public function show(CreditorNote $creditorNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CreditorNote  $creditorNote
     * @return \Illuminate\Http\Response
     */
    public function edit(CreditorNote $creditorNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCreditorNoteRequest  $request
     * @param  \App\Models\CreditorNote  $creditorNote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCreditorNoteRequest $request, CreditorNote $creditorNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CreditorNote  $creditorNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(CreditorNote $creditorNote)
    {
        $creditorNote->delete();

        return Redirect::back();
    }
}
