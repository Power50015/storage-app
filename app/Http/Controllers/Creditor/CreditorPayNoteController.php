<?php

namespace App\Http\Controllers\Creditor;

use App\Http\Controllers\Controller;
use App\Models\Creditor\CreditorPayNote;
use App\Http\Requests\Creditor\StoreCreditorPayNoteRequest;
use App\Http\Requests\Creditor\UpdateCreditorPayNoteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class CreditorPayNoteController extends Controller
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
            "note" => CreditorPayNote::with('user')->latest()->where('creditor_pay_id', $note)->when(Request::input('search'), function ($query, $search) {
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
     * @param  \App\Http\Requests\StoreCreditorPayNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCreditorPayNoteRequest $request)
    {
        CreditorPayNote::create([
            'note' => $request->note,
            'creditor_pay_id' => $request->id,
            'tag' => $request->tag,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CreditorPayNote  $creditorPayNote
     * @return \Illuminate\Http\Response
     */
    public function show(CreditorPayNote $creditorPayNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CreditorPayNote  $creditorPayNote
     * @return \Illuminate\Http\Response
     */
    public function edit(CreditorPayNote $creditorPayNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCreditorPayNoteRequest  $request
     * @param  \App\Models\CreditorPayNote  $creditorPayNote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCreditorPayNoteRequest $request, CreditorPayNote $creditorPayNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CreditorPayNote  $creditorPayNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(CreditorPayNote $creditorPayNote)
    {
        $creditorPayNote->delete();

        return Redirect::back();
    }
}
