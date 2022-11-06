<?php

namespace App\Http\Controllers\Debtor;

use App\Http\Controllers\Controller;
use App\Models\Debtor\DebtorNote;
use App\Http\Requests\Debtor\StoreDebtorNoteRequest;
use App\Http\Requests\Debtor\UpdateDebtorNoteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class DebtorNoteController extends Controller
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
            "note" => DebtorNote::with('user')->latest()->where('debtor_id', $note)->when(Request::input('search'), function ($query, $search) {
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
     * @param  \App\Http\Requests\StoreDebtorNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDebtorNoteRequest $request)
    {
        DebtorNote::create([
            'note' => $request->note,
            'debtor_id' => $request->id,
            'tag' => $request->tag,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DebtorNote  $debtorNote
     * @return \Illuminate\Http\Response
     */
    public function show(DebtorNote $debtorNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DebtorNote  $debtorNote
     * @return \Illuminate\Http\Response
     */
    public function edit(DebtorNote $debtorNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDebtorNoteRequest  $request
     * @param  \App\Models\DebtorNote  $debtorNote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDebtorNoteRequest $request, DebtorNote $debtorNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DebtorNote  $debtorNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(DebtorNote $debtorNote)
    {
        $debtorNote->delete();

        return Redirect::back();
    }
}
