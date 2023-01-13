<?php

namespace App\Http\Controllers\Cash;

use App\Http\Controllers\Controller;
use App\Models\Cash\CashNote;
use App\Http\Requests\Cash\StoreCashNoteRequest;
use App\Http\Requests\Cash\UpdateCashNoteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class CashNoteController extends Controller
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
            "note" => CashNote::with('user')->latest()->where('cash_id', $note)->when(Request::input('search'), function ($query, $search) {
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
     * @param  \App\Http\Requests\StoreCashNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCashNoteRequest $request)
    {
        CashNote::create([
            'note' => $request->note,
            'cash_id' => $request->id,
            'tag' => $request->tag,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CashNote  $cashNote
     * @return \Illuminate\Http\Response
     */
    public function show(CashNote $cashNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CashNote  $cashNote
     * @return \Illuminate\Http\Response
     */
    public function edit(CashNote $cashNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCashNoteRequest  $request
     * @param  \App\Models\CashNote  $cashNote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCashNoteRequest $request, CashNote $cashNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashNote  $cashNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashNote $cashNote)
    {
        $cashNote->delete();

        return Redirect::back();
    }
}
