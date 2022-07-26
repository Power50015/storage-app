<?php

namespace App\Http\Controllers;

use App\Models\CreditorPay;
use App\Http\Requests\StoreCreditorPayRequest;
use App\Http\Requests\UpdateCreditorPayRequest;
use App\Models\Cash;
use App\Models\CreditorPayAttachment;
use App\Models\People;
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
        return Inertia::render('Creditor/CreateCreditorPay', [
            "cash" => Cash::all(),
            "companies" => People::orderBy("type")->get()
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
            'cash_type' => $request->cash_type,
            'company' => $request->companies,
            'user' => Auth::id()
        ]);

        // Save Attachment Of Creditor
        for ($i = 0; $i <  count($request["attachment"]); $i++) {
            if ($request["attachment"][$i]["attachment"] != null) {
                $attachment_path = $request["attachment"][$i]["attachment"]->store('attachment/creditorPay', 'public');
                CreditorPayAttachment::create([
                    'attachment' =>  $attachment_path,
                    'creditor_pay' => $creditorPay['id'],
                    'user' => Auth::id()
                ]);
            }
        }

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CreditorPay  $creditorPay
     * @return \Illuminate\Http\Response
     */
    public function edit(CreditorPay $creditorPay)
    {
        //
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
        //
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
