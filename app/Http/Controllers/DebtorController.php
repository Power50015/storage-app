<?php

namespace App\Http\Controllers;

use App\Models\Debtor;
use App\Http\Requests\StoreDebtorRequest;
use App\Http\Requests\UpdateDebtorRequest;
use App\Models\Cash;
use App\Models\DebtorAttachment;
use App\Models\People;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Debtor/CreateDebtor', [
            "cash" => Cash::all(),
            "companies" => People::orderBy("type")->get()
        ]);
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
            'people_id' => $request->companies,
            'user_id' => Auth::id()
        ]);
        
        // Save Attachment Of Debtor
        for ($i = 0; $i <  count($request["attachment"]); $i++) {
            if ($request["attachment"][$i]["attachment"] != null) {
                $attachment_path = $request["attachment"][$i]["attachment"]->store('attachment/debtor', 'public');
                DebtorAttachment::create([
                    'attachment' =>  $attachment_path,
                    'debtor_id' => $debtor['id'],
                    'user_id' => Auth::id()
                ]);
            }
        }

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Debtor  $debtor
     * @return \Illuminate\Http\Response
     */
    public function show(Debtor $debtor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Debtor  $debtor
     * @return \Illuminate\Http\Response
     */
    public function edit(Debtor $debtor)
    {
        //
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
        //
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
}
