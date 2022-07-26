<?php

namespace App\Http\Controllers;

use App\Models\Creditor;
use App\Http\Requests\StoreCreditorRequest;
use App\Http\Requests\UpdateCreditorRequest;
use App\Models\Cash;
use App\Models\CreditorAttachment;
use App\Models\People;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Creditor/CreateCreditor', [
            "cash" => Cash::all(),
            "companies" => People::orderBy("type")->get()
        ]);
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
            'people_id' => $request->companies,
            'user_id' => Auth::id()
        ]);
        
        // Save Attachment Of Debtor
        for ($i = 0; $i <  count($request["attachment"]); $i++) {
            if ($request["attachment"][$i]["attachment"] != null) {
                $attachment_path = $request["attachment"][$i]["attachment"]->store('attachment/creditor', 'public');
                CreditorAttachment::create([
                    'attachment' =>  $attachment_path,
                    'creditor_id' => $creditor['id'],
                    'user_id' => Auth::id()
                ]);
            }
        }

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Creditor  $creditor
     * @return \Illuminate\Http\Response
     */
    public function show(Creditor $creditor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Creditor  $creditor
     * @return \Illuminate\Http\Response
     */
    public function edit(Creditor $creditor)
    {
        //
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
        //
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
}
