<?php

namespace App\Http\Controllers;

use App\Models\DebtorPay;
use App\Http\Requests\StoreDebtorPayRequest;
use App\Http\Requests\UpdateDebtorPayRequest;
use App\Models\Cash;
use App\Models\DebtorPayAttachment;
use App\Models\People;
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
        return Inertia::render('Debtor/CreateDebtorPay', [
            "cash" => Cash::all(),
            "companies" => People::orderBy("type")->get()
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
            'cash_id' => $request->cash_type,
            'people_id' => $request->companies,
            'user_id' => Auth::id()
        ]);

        // Save Attachment Of Debtor
        for ($i = 0; $i <  count($request["attachment"]); $i++) {
            if ($request["attachment"][$i]["attachment"] != null) {
                $attachment_path = $request["attachment"][$i]["attachment"]->store('attachment/debtorPay', 'public');
                DebtorPayAttachment::create([
                    'attachment' =>  $attachment_path,
                    'debtor_pay_id' => $debtorPay['id'],
                    'user_id' => Auth::id()
                ]);
            }
        }

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DebtorPay  $debtorPay
     * @return \Illuminate\Http\Response
     */
    public function show(DebtorPay $debtorPay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DebtorPay  $debtorPay
     * @return \Illuminate\Http\Response
     */
    public function edit(DebtorPay $debtorPay)
    {
        //
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
        //
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
