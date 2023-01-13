<?php

namespace App\Http\Controllers\Cash;

use App\Http\Controllers\Controller;
use App\Models\Cash\Cash;
use App\Http\Requests\Cash\StoreCashRequest;
use App\Http\Requests\Cash\UpdateCashRequest;
use App\Models\Cash\CashPay;
use App\Models\Creditor\CreditorPay;
use App\Models\Debtor\DebtorPay;
use App\Models\Expense\Expense;
use App\Models\IncomingInvoice\IncomingInvoice;
use App\Models\OutgoingInvoice\OutgoingInvoice;
use App\Models\ReturnedIncomingInvoice\ReturnedIncomingInvoice;
use App\Models\ReturnedOutgoingInvoice\ReturnedOutgoingInvoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;


class CashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Cash/Index', [
            "cash" =>  Cash::query()->with('user')->when(Request::input('search'), function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })->paginate()->withQueryString(),
            "totalCashesWay" => Cash::count(),
            "totalCashes" => Cash::sum('available'),
            'filters' => Request::only(['search'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Cash/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCashRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCashRequest $request)
    {
        Cash::create([
            'title' => $request->title,
            'user_id' => Auth::id(),
            'available' => 0
        ]);

        return Redirect::route('cash.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function show(Cash $cash)
    {
        return Inertia::render('Cash/Show', [
            "cash" => Cash::where('id', $cash->id)->with('user')->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function edit(Cash $cash)
    {
        return Inertia::render('Cash/Create', [
            "cash" => $cash,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCashRequest  $request
     * @param  \App\Models\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCashRequest $request, Cash $cash)
    {
        $cash->title = $request->title;
        $cash->save();
        return Redirect::route('cash.show', $cash->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cash $cash)
    {
        //
    }

    public function data()
    {
        $cash = Request::input('cash');
        $action = Request::input('action');

        // Get Actions

        $actionData = collect([]);

        //  Cash Pay
        if ($action == "CashPay" || $action == "all") {
            $CashPay = CashPay::with('user')->where('cash_id', $cash)->get();
            foreach ($CashPay as $key => $value) {
                $CashPay[$key]["dataType"] = "CashPay";
                $actionData->push($CashPay[$key]);
            }
        }
        //  Creditor Pay
        if ($action == "CreditorPay" || $action == "all") {
            $CreditorPay = CreditorPay::with('user', 'pepole')->where('cash_id', $cash)->get();
            foreach ($CreditorPay as $key => $value) {
                $CreditorPay[$key]["dataType"] = "CreditorPay";
                $actionData->push($CreditorPay[$key]);
            }
        }
        //  Debtor Pay
        if ($action == "DebtorPay" || $action == "all") {
            $DebtorPay = DebtorPay::with('user', 'pepole')->where('cash_id', $cash)->get();
            foreach ($DebtorPay as $key => $value) {
                $DebtorPay[$key]["dataType"] = "DebtorPay";
                $actionData->push($DebtorPay[$key]);
            }
        }
        //  Incoming Invoice
        if ($action == "IncomingInvoice" || $action == "all") {
            $IncomingInvoice = IncomingInvoice::with('user', 'pepole', 'warehouse')->where('cash_id', $cash)->where('pay_type', 1)->get();
            foreach ($IncomingInvoice as $key => $value) {
                $IncomingInvoice[$key]["dataType"] = "IncomingInvoice";
                $actionData->push($IncomingInvoice[$key]);
            }
        }
        //  Returned Incoming Invoice
        if ($action == "ReturnedIncomingInvoice" || $action == "all") {
            $ReturnedIncomingInvoice = ReturnedIncomingInvoice::with('user', 'pepole', 'warehouse')->where('cash_id', $cash)->where('pay_type', 1)->get();
            foreach ($ReturnedIncomingInvoice as $key => $value) {
                $ReturnedIncomingInvoice[$key]["dataType"] = "ReturnedIncomingInvoice";
                $actionData->push($ReturnedIncomingInvoice[$key]);
            }
        }
        //  Outgoing Invoice
        if ($action == "OutgoingInvoice" || $action == "all") {
            $OutgoingInvoice = OutgoingInvoice::with('user', 'pepole', 'warehouse')->where('cash_id', $cash)->where('pay_type', 1)->get();
            foreach ($OutgoingInvoice as $key => $value) {
                $OutgoingInvoice[$key]["dataType"] = "OutgoingInvoice";
                $actionData->push($OutgoingInvoice[$key]);
            }
        }
        //  Returned Outgoing Invoice
        if ($action == "ReturnedOutgoingInvoice" || $action == "all") {
            $ReturnedOutgoingInvoice = ReturnedOutgoingInvoice::with('user', 'pepole', 'warehouse')->where('cash_id', $cash)->where('pay_type', 1)->get();
            foreach ($ReturnedOutgoingInvoice as $key => $value) {
                $ReturnedOutgoingInvoice[$key]["dataType"] = "ReturnedOutgoingInvoice";
                $actionData->push($ReturnedOutgoingInvoice[$key]);
            }
        }
        //  Expense
        if ($action == "Expense" || $action == "all") {
            $Expense = Expense::with('user')->where('cash_id', $cash)->get();
            foreach ($Expense as $key => $value) {
                $Expense[$key]["dataType"] = "Expense";
                $actionData->push($Expense[$key]);
            }
        }


        $actionData = $actionData->sortByDesc('date')->paginate();

        return $actionData;
    }
}
