<?php

namespace App\Http\Controllers\Creditor;

use App\Http\Controllers\Controller;
use App\Models\Creditor\CreditorPay;
use App\Http\Requests\Creditor\StoreCreditorPayRequest;
use App\Http\Requests\Creditor\UpdateCreditorPayRequest;
use App\Models\Cash\Cash;
use App\Models\People\People;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CreditorPayController extends Controller
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
        return Inertia::render('Creditor/Pay/Create', [
            "cash" => Cash::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCreditorPayRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCreditorPayRequest $request)
    {
        // Save the Creditor
        $creditorPay = CreditorPay::create([
            'title' => $request->title,
            'amount' => $request->amount,
            'description' => $request->description,
            'pay_type' => $request->pay_type,
            'cash_id' => $request->cash_type,
            'date' => Carbon::parse($request->date),
            'people_id' => $request->people_id,
            'user_id' => Auth::id()
        ]);

        $people = People::find($request->people_id);
        $people->balance = $people->balance - $request->amount;
        $people->save();

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CreditorPay  $creditorPay
     * @return \Illuminate\Http\Response
     */
    public function show(CreditorPay $creditorPay)
    {
        return Inertia::render('Creditor/Pay/Show', [
            "creditorPay" =>  CreditorPay::where('id', $creditorPay->id)->with('user', 'people', 'cash')->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CreditorPay  $creditorPay
     * @return \Illuminate\Http\Response
     */
    public function edit(CreditorPay $creditorPay)
    {
        return Inertia::render('Creditor/Pay/Create', [
            "cash" => Cash::all(),
            "creditorPay" =>  $creditorPay,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCreditorPayRequest  $request
     * @param  \App\Models\CreditorPay  $creditorPay
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCreditorPayRequest $request, CreditorPay $creditorPay)
    {

        $people = People::find($request->people_id);
        $people->balance = $people->balance + $creditorPay->amount; // Delete the old value
        $people->balance = $people->balance - $request->amount; // add the new value
        $people->save();


        $creditorPay->title = $request->title;
        $creditorPay->amount = $request->amount;
        $creditorPay->description = $request->description;
        $creditorPay->pay_type = $request->pay_type;
        $creditorPay->cash_id = $request->cash_id;
        $creditorPay->date = Carbon::parse($request->date);
        $creditorPay->people_id = $request->people_id;
        $creditorPay->save();
        return Redirect::route('debtor-pay.show', $creditorPay->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CreditorPay  $creditorPay
     * @return \Illuminate\Http\Response
     */
    public function destroy(CreditorPay $creditorPay)
    {
        //
    }
}
