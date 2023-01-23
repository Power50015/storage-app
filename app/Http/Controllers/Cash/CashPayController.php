<?php

namespace App\Http\Controllers\Cash;

use App\Http\Controllers\Controller;
use App\Models\Cash\CashPay;
use App\Http\Requests\Cash\StoreCashPayRequest;
use App\Http\Requests\Cash\UpdateCashPayRequest;
use App\Models\Cash\Cash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CashPayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Cash/Pay/Create', [
            "cash" => Cash::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCashPayRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCashPayRequest $request)
    {
        // Save the CashPay
        $cashPay = CashPay::create([
            'title' => $request->title,
            'amount' => $request->amount,
            'cash_id' => $request->cash_id,
            'date' => Carbon::parse($request->date),
            'user_id' => Auth::id()
        ]);

        $cash = Cash::find($request->cash_id);
        $cash->available = $cash->available + $request->amount;
        $cash->save();


        return Redirect::route('cash-pay.show', $cashPay->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CashPay  $cashPay
     * @return \Illuminate\Http\Response
     */
    public function show(CashPay $cashPay)
    {
        return Inertia::render('Cash/Pay/Show', [
            "cashPay" =>  CashPay::where('id', $cashPay->id)->with('user', 'cash')->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CashPay  $cashPay
     * @return \Illuminate\Http\Response
     */
    public function edit(CashPay $cashPay)
    {
        return Inertia::render('Cash/Pay/Create', [
            "cash" => Cash::all(),
            "cashPay" =>  $cashPay,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCashPayRequest  $request
     * @param  \App\Models\CashPay  $cashPay
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCashPayRequest $request, CashPay $cashPay)
    {

        $cash = Cash::find($request->cash_id);
        $cash->available = $cash->available - $cashPay->amount;
        $cash->available = $cash->available + $cashPay->amount;
        $cash->save();

        $cashPay->title = $request->title;
        $cashPay->amount = $request->amount;
        $cashPay->cash_id = $request->cash_id;
        $cashPay->date = Carbon::parse($request->date);
        $cashPay->save();

        return Redirect::route('cash-pay.show', $cashPay->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashPay  $cashPay
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashPay $cashPay)
    {
        //
    }
}
