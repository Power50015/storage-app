<?php

namespace App\Http\Controllers\Debtor;

use App\Http\Controllers\Controller;
use App\Models\Debtor\Debtor;
use App\Http\Requests\Debtor\StoreDebtorRequest;
use App\Http\Requests\Debtor\UpdateDebtorRequest;
use App\Models\Cash\Cash;
use App\Models\Debtor\DebtorAttachment;
use App\Models\Debtor\DebtorPay;
use App\Models\OutgoingInvoice\OutgoingInvoice;
use App\Models\People\People;
use App\Models\ReturnedIncomingInvoice\ReturnedIncomingInvoice;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class DebtorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Debtor/Index', [
            "debtor_count" =>  People::get()->where('balance', '<', 0)->count(),
            "debtor_total" =>  People::get()->where('balance', '<', 0)->sum('balance'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Debtor/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDebtorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDebtorRequest $request)
    {
        // Save the Debtor
        $debtor = Debtor::create([
            'title' => $request->title,
            'amount' => $request->amount,
            'description' => $request->description,
            'date' => Carbon::parse($request->date),
            'people_id' => $request->people_id,
            'user_id' => Auth::id()
        ]);

        $people = People::find($request->people_id);
        $people->balance = $people->balance - $request->amount; // add the new value
        $people->save();

        return Redirect::route('debtor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Debtor  $debtor
     * @return \Illuminate\Http\Response
     */
    public function show(Debtor $debtor)
    {
        return Inertia::render('Debtor/Show', [
            "debtor" =>  Debtor::where('id', $debtor->id)->with('user', 'people')->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Debtor  $debtor
     * @return \Illuminate\Http\Response
     */
    public function edit(Debtor $debtor)
    {
        return Inertia::render('Debtor/Create', [
            "debtor" =>  $debtor,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDebtorRequest  $request
     * @param  \App\Models\Debtor  $debtor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDebtorRequest $request, Debtor $debtor)
    {

        $people = People::find($request->people_id);
        $people->balance = $people->balance + $debtor->amount; // Delete the old value
        $people->balance = $people->balance - $request->amount; // add the new value

        $people->save();


        $debtor->title = $request->title;
        $debtor->amount = $request->amount;
        $debtor->description = $request->description;
        $debtor->date = Carbon::parse($request->date);
        $debtor->people_id = $request->people_id;
        $debtor->save();
        return Redirect::route('debtor.show', $debtor->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Debtor  $debtor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Debtor $debtor)
    {
        //
    }

    public function debtorPeople()
    {
        return [
            "people" => People::query()->where('balance', '<', 0)->when(Request::input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })->paginate()->withQueryString(),
            'filters' => Request::only(['search'])
        ];
    }
    public function debtorAction()
    {
        $action = Request::input('action');

        // Get Actions
        $actionData = collect([]);
        //  Outgoing Invoice
        if ($action == "OutgoingInvoice" || $action == "all") {
            $OutgoingInvoiceContent = OutgoingInvoice::with('user', 'people')->where('pay_type', 0)->get();
            foreach ($OutgoingInvoiceContent as $key => $value) {
                $OutgoingInvoiceContent[$key]["dataType"] = "OutgoingInvoice";

                $actionData->push($OutgoingInvoiceContent[$key]);
            }
        }
        //  Returned Incoming Invoice Content
        if ($action == "ReturnedIncomingInvoice" || $action == "all") {
            $ReturnedIncomingInvoiceContent = ReturnedIncomingInvoice::with('user', 'people')->where('pay_type', 0)->get();
            foreach ($ReturnedIncomingInvoiceContent as $key => $value) {
                $ReturnedIncomingInvoiceContent[$key]["dataType"] = "ReturnedIncomingInvoice";
                $actionData->push($ReturnedIncomingInvoiceContent[$key]);
            }
        }
        if ($action == "Debtor" || $action == "all") {
            $Debtor = Debtor::with('user', 'people')->get();
            foreach ($Debtor as $key => $value) {
                $Debtor[$key]["dataType"] = "Debtor";
                $actionData->push($Debtor[$key]);
            }
        }

        if ($action == "DebtorKilled" || $action == "all") {
            $Debtor = DebtorPay::with('user', 'people')->where('pay_type', 0)->get();
            foreach ($Debtor as $key => $value) {
                $Debtor[$key]["dataType"] = "DebtorKilled";
                $actionData->push($Debtor[$key]);
            }
        }

        if ($action == "DebtorPay" || $action == "all") {
            $Debtor = DebtorPay::with('user', 'people', 'cash')->where('pay_type', 1)->get();
            foreach ($Debtor as $key => $value) {
                $Debtor[$key]["dataType"] = "DebtorPay";
                $actionData->push($Debtor[$key]);
            }
        }


        $actionData = $actionData->sortByDesc('date')->paginate();

        return $actionData;
    }
}
