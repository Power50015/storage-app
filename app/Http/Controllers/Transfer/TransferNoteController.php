<?php

namespace App\Http\Controllers\Transfer;

use App\Http\Controllers\Controller;
use App\Models\Transfer\TransferNote;
use App\Http\Requests\Transfer\StoreTransferNoteRequest;
use App\Http\Requests\Transfer\UpdateTransferNoteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;


class TransferNoteController extends Controller
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
            "note" => TransferNote::with('user')->latest()->where('transfer_id', $note)->when(Request::input('search'), function ($query, $search) {
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
     * @param  \App\Http\Requests\StoreTransferNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransferNoteRequest $request)
    {
        TransferNote::create([
            'note' => $request->note,
            'transfer_id' => $request->id,
            'tag' => $request->tag,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransferNote  $transferNote
     * @return \Illuminate\Http\Response
     */
    public function show(TransferNote $transferNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransferNote  $transferNote
     * @return \Illuminate\Http\Response
     */
    public function edit(TransferNote $transferNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransferNoteRequest  $request
     * @param  \App\Models\TransferNote  $transferNote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransferNoteRequest $request, TransferNote $transferNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransferNote  $transferNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransferNote $transferNote)
    {
        $transferNote->delete();

        return Redirect::back();
    }
}
