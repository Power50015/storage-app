<?php

namespace App\Http\Controllers\Expense;


use App\Http\Controllers\Controller;
use App\Models\Expense\ExpenseAttachment;
use App\Http\Requests\Expense\StoreExpenseAttachmentRequest;
use App\Http\Requests\Expense\UpdateExpenseAttachmentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class ExpenseAttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $file = Request::input('id');
        $search = Request::input('search');
        return [
            "attachment" => ExpenseAttachment::with('user')->latest()->where('expense_id', $file)->when(Request::input('search'), function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
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
     * @param  \App\Http\Requests\StoreExpenseAttachmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExpenseAttachmentRequest $request)
    {
        $attachment_path = $request["attachment"]->store('attachment/expenses', 'public');
        ExpenseAttachment::create([
            'attachment' =>  $attachment_path,
            'expense_id' => $request->id,
            'title' => $request->title,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expee\ExpenseAttachment  $expenseAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenseAttachment $expenseAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expee\ExpenseAttachment  $expenseAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpenseAttachment $expenseAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExpenseAttachmentRequest  $request
     * @param  \App\Models\Expee\ExpenseAttachment  $expenseAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpenseAttachmentRequest $request, ExpenseAttachment $expenseAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expee\ExpenseAttachment  $expenseAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenseAttachment $expenseAttachment)
    {
        Storage::delete("public/" . $expenseAttachment["attachment"]);
        $expenseAttachment->delete();

        return Redirect::back();
    }
}
