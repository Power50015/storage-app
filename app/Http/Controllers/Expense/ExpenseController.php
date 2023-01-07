<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use App\Models\Expense\Expense;
use App\Http\Requests\Expense\StoreExpenseRequest;
use App\Http\Requests\Expense\UpdateExpenseRequest;
use App\Models\Cash\Cash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Expense/Index', [
            "expense" => Expense::with('user', 'cash')->orderBy('date', 'desc')->latest()->when(
                Request::input('search'),
                function ($query, $search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('date', 'like', "%{$search}%")
                        ->orWhereRelation('cash', 'title', 'like', "%{$search}%");
                }
            )->paginate(35)->withQueryString(),

            'filters' => Request::only(['search']),
            'totalExpense' => Expense::count(),
            'totalExpenseThisDay' => Expense::where('date', '>=', Carbon::now()->locale('eg')->toDateString())->sum('amount'),
            'totalExpenseThisWeek' => Expense::where('date', '>=', Carbon::now()->startOfWeek()->subWeek()->toDateString())->sum('amount'),
            'totalExpenseThisMonth' => Expense::where('date', '>=', Carbon::now()->startOfMonth()->subMonth()->toDateString())->sum('amount'),
            'totalExpenseThisYear' => Expense::where('date', '>=', Carbon::now()->startOfYear()->subMonth()->toDateString())->sum('amount'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Expense/Create', [
            "cash" => Cash::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExpenseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExpenseRequest $request)
    {
        $expense = Expense::create([
            'title' => $request->title,
            'amount' => $request->amount,
            'description' => $request->description,
            'date' => Carbon::parse($request->date),
            'cash_id' => $request->cash_id,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('expense.show', $expense['id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        return Inertia::render('Expense/Show', [
            "expense" => Expense::where('id', $expense->id)->with('user', 'cash')->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        return Inertia::render('Expense/Create', [
            "expense" =>  Expense::where('id', $expense->id)->with('user', 'cash')->get(),
            "cash" => Cash::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExpenseRequest  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        $expense->title = $request->title;
        $expense->amount = $request->amount;
        $expense->description = $request->description;
        $expense->date = Carbon::parse($request->date);
        $expense->cash_id = $request->cash_id;
        $expense->save();
        return Redirect::route('expense.show', $expense->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        //
    }
}
