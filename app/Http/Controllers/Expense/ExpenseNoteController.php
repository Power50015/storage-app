<?php

namespace App\Http\Controllers\Expense;

use App\Models\Expense\ExpenseNote;
use App\Http\Requests\Expense\StoreExpenseNoteRequest;
use App\Http\Requests\Expense\UpdateExpenseNoteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;

class ExpenseNoteController extends Controller
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
            "note" => ExpenseNote::with('user')->latest()->where('expense_id', $note)->when(Request::input('search'), function ($query, $search) {
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
     * @param  \App\Http\Requests\StoreExpenseNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExpenseNoteRequest $request)
    {
        ExpenseNote::create([
            'note' => $request->note,
            'expense_id' => $request->id,
            'tag' => $request->tag,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpenseNote  $expenseNote
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenseNote $expenseNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpenseNote  $expenseNote
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpenseNote $expenseNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExpenseNoteRequest  $request
     * @param  \App\Models\ExpenseNote  $expenseNote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpenseNoteRequest $request, ExpenseNote $expenseNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpenseNote  $expenseNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenseNote $expenseNote)
    {
        $expenseNote->delete();

        return Redirect::back();
    }
}
