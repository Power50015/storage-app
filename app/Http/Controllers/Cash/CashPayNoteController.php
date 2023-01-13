<?php

namespace App\Http\Controllers\Cash;

use App\Http\Controllers\Controller;
use App\Models\Cash\CashPayNote;
use App\Http\Requests\Cash\StoreCashPayNoteRequest;
use App\Http\Requests\Cash\UpdateCashPayNoteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class CashPayNoteController extends Controller
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
            "note" => CashPayNote::with('user')->latest()->where('cash_pay_id', $note)->when(Request::input('search'), function ($query, $search) {
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
     * @param  \App\Http\Requests\StoreCashPayNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCashPayNoteRequest $request)
    {
        CashPayNote::create([
            'note' => $request->note,
            'cash_pay_id' => $request->id,
            'tag' => $request->tag,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CashPayNote  $cashPayNote
     * @return \Illuminate\Http\Response
     */
    public function show(CashPayNote $cashPayNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CashPayNote  $cashPayNote
     * @return \Illuminate\Http\Response
     */
    public function edit(CashPayNote $cashPayNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCashPayNoteRequest  $request
     * @param  \App\Models\CashPayNote  $cashPayNote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCashPayNoteRequest $request, CashPayNote $cashPayNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashPayNote  $cashPayNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashPayNote $cashPayNote)
    {
        $cashPayNote->delete();

        return cashPayNote::back();
    }
}
