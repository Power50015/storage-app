<?php

namespace App\Http\Controllers\Debtor;

use App\Http\Controllers\Controller;
use App\Models\Debtor\DebtorPayNote;
use App\Http\Requests\Debtor\StoreDebtorPayNoteRequest;
use App\Http\Requests\Debtor\UpdateDebtorPayNoteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class DebtorPayNoteController extends Controller
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
            "note" => DebtorPayNote::with('user')->latest()->where('debtor_pay_id', $note)->when(Request::input('search'), function ($query, $search) {
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
     * @param  \App\Http\Requests\StoreDebtorPayNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDebtorPayNoteRequest $request)
    {
        DebtorPayNote::create([
            'note' => $request->note,
            'debtor_pay_id' => $request->id,
            'tag' => $request->tag,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DebtorPayNote  $debtorPayNote
     * @return \Illuminate\Http\Response
     */
    public function show(DebtorPayNote $debtorPayNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DebtorPayNote  $debtorPayNote
     * @return \Illuminate\Http\Response
     */
    public function edit(DebtorPayNote $debtorPayNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDebtorPayNoteRequest  $request
     * @param  \App\Models\DebtorPayNote  $debtorPayNote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDebtorPayNoteRequest $request, DebtorPayNote $debtorPayNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DebtorPayNote  $debtorPayNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(DebtorPayNote $debtorPayNote)
    {
        $debtorPayNote->delete();

        return Redirect::back();
    }
}
