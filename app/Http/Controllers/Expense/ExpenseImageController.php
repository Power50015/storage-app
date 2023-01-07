<?php

namespace App\Http\Controllers\Expense;
use App\Http\Controllers\Controller;
use App\Models\Expense\ExpenseImage;
use App\Http\Requests\Expense\StoreExpenseImageRequest;
use App\Http\Requests\Expense\UpdateExpenseImageRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class ExpenseImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $debtor = Request::input('id');
        return [
            "image" => ExpenseImage::where('expense_id', $debtor)->with('user')->latest()->paginate()
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
     * @param  \App\Http\Requests\StoreExpenseImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExpenseImageRequest $request)
    {
        ExpenseImage::create([
            'image' =>  $request["image"]->store('image/expenses', 'public'),
            'expense_id' => $request->id,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpenseImage  $expenseImage
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenseImage $expenseImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpenseImage  $expenseImage
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpenseImage $expenseImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExpenseImageRequest  $request
     * @param  \App\Models\ExpenseImage  $expenseImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpenseImageRequest $request, ExpenseImage $expenseImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpenseImage  $expenseImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenseImage $expenseImage)
    {
        Storage::delete("public/" . $expenseImage["image"]);
        $expenseImage->delete();

        return Redirect::back();
    }
}
