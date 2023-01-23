<?php

namespace App\Http\Controllers\Debtor;

use App\Http\Controllers\Controller;
use App\Models\Debtor\DebtorPay;
use App\Http\Requests\Debtor\StoreDebtorPayRequest;
use App\Http\Requests\Debtor\UpdateDebtorPayRequest;
use App\Models\Cash\Cash;
use App\Models\Debtor\DebtorPayAttachment;
use App\Models\People\People;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class DebtorPayController extends Controller
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
        return Inertia::render('Debtor/Pay/Create', [
            "cash" => Cash::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDebtorPayRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDebtorPayRequest $request)
    {
        // Save the Debtor
        $debtorPay = DebtorPay::create([
            'title' => $request->title,
            'amount' => $request->amount,
            'description' => $request->description,
            'pay_type' => $request->pay_type,
            'cash_id' => $request->cash_id,
            'date' => Carbon::parse($request->date),
            'people_id' => $request->people_id,
            'user_id' => Auth::id()
        ]);

        $people = People::find($request->people_id);
        $people->balance = $people->balance - $request->amount;
        $people->save();


        if ($request->cash_id) {
            $cash = Cash::find($request->cash_id);
            $cash->available = $cash->available + $request->amount;
            $cash->save();
        }
        return Redirect::route('debtor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DebtorPay  $debtorPay
     * @return \Illuminate\Http\Response
     */
    public function show(DebtorPay $debtorPay)
    {
        return Inertia::render('Debtor/Pay/Show', [
            "debtorPay" =>  DebtorPay::where('id', $debtorPay->id)->with('user', 'people', 'cash')->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DebtorPay  $debtorPay
     * @return \Illuminate\Http\Response
     */
    public function edit(DebtorPay $debtorPay)
    {
        return Inertia::render('Debtor/Pay/Create', [
            "cash" => Cash::all(),
            "debtor" =>  $debtorPay,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDebtorPayRequest  $request
     * @param  \App\Models\DebtorPay  $debtorPay
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDebtorPayRequest $request, DebtorPay $debtorPay)
    {

        $people = People::find($request->people_id);
        $people->balance = $people->balance + $debtorPay->amount; // Delete the old value
        $people->balance = $people->balance - $request->amount; // add the new value
        $people->save();

        if ($request->cash_id) {
            $cash = Cash::find($request->cash_id);
            $cash->available = $cash->available - $debtorPay->amount;
            $cash->available = $cash->available + $request->amount;
            $cash->save();
        }

        $debtorPay->title = $request->title;
        $debtorPay->amount = $request->amount;
        $debtorPay->description = $request->description;
        $debtorPay->pay_type = $request->pay_type;
        $debtorPay->cash_id = $request->cash_id;
        $debtorPay->date = Carbon::parse($request->date);
        $debtorPay->people_id = $request->people_id;
        $debtorPay->save();
        return Redirect::route('debtor-pay.show', $debtorPay->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DebtorPay  $debtorPay
     * @return \Illuminate\Http\Response
     */
    public function destroy(DebtorPay $debtorPay)
    {
        //
    }
}
