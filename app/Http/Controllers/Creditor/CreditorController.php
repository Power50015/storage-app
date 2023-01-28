<?php

namespace App\Http\Controllers\Creditor;

use App\Http\Controllers\Controller;
use App\Models\Creditor\Creditor;
use App\Http\Requests\Creditor\StoreCreditorRequest;
use App\Http\Requests\Creditor\UpdateCreditorRequest;
use App\Models\Cash\Cash;
use App\Models\Creditor\CreditorPay;
use App\Models\IncomingInvoice\IncomingInvoice;
use App\Models\People\People;
use App\Models\ReturnedOutgoingInvoice\ReturnedOutgoingInvoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class CreditorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Creditor/Index', [
            "creditor_count" =>  People::get()->where('balance', '>', 0)->count(),
            "creditor_total" =>  People::get()->where('balance', '>', 0)->sum('balance'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Creditor/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCreditorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCreditorRequest $request)
    {
        // Save the Debtor
        $creditor = Creditor::create([
            'title' => $request->title,
            'amount' => $request->amount,
            'description' => $request->description,
            'date' => Carbon::parse($request->date),
            'people_id' => $request->people_id,
            'user_id' => Auth::id()
        ]);

        $people = People::find($request->people_id);
        $people->balance = $people->balance + $request->amount;
        $people->save();

        return Redirect::route('creditor.show', $creditor->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Creditor  $creditor
     * @return \Illuminate\Http\Response
     */
    public function show(Creditor $creditor)
    {
        return Inertia::render('Creditor/Show', [
            "creditor" =>  Creditor::where('id', $creditor->id)->with('user', 'people')->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Creditor  $creditor
     * @return \Illuminate\Http\Response
     */
    public function edit(Creditor $creditor)
    {
        return Inertia::render('Creditor/Create', [
            "creditor" =>  $creditor,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCreditorRequest  $request
     * @param  \App\Models\Creditor  $creditor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCreditorRequest $request, Creditor $creditor)
    {
        $people = People::find($request->people_id);
        $people->balance = $people->balance - $creditor->amount; // Delete the old value
        $people->balance = $people->balance + $request->amount; // add the new value
        $people->save();

        $creditor->title = $request->title;
        $creditor->amount = $request->amount;
        $creditor->description = $request->description;
        $creditor->date = Carbon::parse($request->date);
        $creditor->people_id = $request->people_id;
        $creditor->save();


        return Redirect::route('creditor.show', $creditor->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Creditor  $creditor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Creditor $creditor)
    {
        //
    }
    public function creditorPeople()
    {
        return [
            "people" => People::query()->where('balance', '>', 0)->when(Request::input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })->paginate()->withQueryString(),
            'filters' => Request::only(['search'])
        ];
    }
    public function creditorAction()
    {

        $action = Request::input('action');

        // Get Actions
        $actionData = collect([]);
        //  Outgoing Invoice
        if ($action == "IncomingInvoice" || $action == "all") {
            $IncomingInvoiceContent = IncomingInvoice::with('user', 'people')->where('pay_type', 0)->get();
            foreach ($IncomingInvoiceContent as $key => $value) {
                $IncomingInvoiceContent[$key]["dataType"] = "IncomingInvoice";

                $actionData->push($IncomingInvoiceContent[$key]);
            }
        }
        //  Returned Incoming Invoice Content
        if ($action == "ReturnedOutgoingInvoice" || $action == "all") {
            $ReturnedOutgoingInvoiceContent = ReturnedOutgoingInvoice::with('user', 'people')->where('pay_type', 0)->get();
            foreach ($ReturnedOutgoingInvoiceContent as $key => $value) {
                $ReturnedOutgoingInvoiceContent[$key]["dataType"] = "ReturnedOutgoingInvoice";
                $actionData->push($ReturnedOutgoingInvoiceContent[$key]);
            }
        }

        if ($action == "Creditor" || $action == "all") {
            $Creditor = Creditor::with('user', 'people')->get();
            foreach ($Creditor as $key => $value) {
                $Creditor[$key]["dataType"] = "Creditor";
                $actionData->push($Creditor[$key]);
            }
        }

        if ($action == "CreditorKilled" || $action == "all") {
            $Creditor = CreditorPay::with('user', 'people', 'cash')->where('pay_type', 0)->get();
            foreach ($Creditor as $key => $value) {
                $Creditor[$key]["dataType"] = "CreditorKilled";
                $actionData->push($Creditor[$key]);
            }
        }

        if ($action == "CreditorPay" || $action == "all") {
            $Creditor = CreditorPay::with('user', 'people', 'cash')->where('pay_type', 1)->get();
            foreach ($Creditor as $key => $value) {
                $Creditor[$key]["dataType"] = "CreditorPay";
                $actionData->push($Creditor[$key]);
            }
        }


        $actionData = $actionData->sortByDesc('date')->paginate();

        return $actionData;
    }
}
