<?php

namespace App\Http\Controllers\Debtor;

use App\Http\Controllers\Controller;
use App\Models\Debtor\DebtorPayAttachment;
use App\Http\Requests\Debtor\StoreDebtorPayAttachmentRequest;
use App\Http\Requests\Debtor\UpdateDebtorPayAttachmentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class DebtorPayAttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $file = Request::input('id');
        $search = Request::input('search');
        return [
            "attachment" => DebtorPayAttachment::with('user')->latest()->where('debtor_pay_id', $file)->when(Request::input('search'), function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })->paginate()->withQueryString(),
            "filters" => $search
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDebtorPayAttachmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDebtorPayAttachmentRequest $request)
    {
        $attachment_path = $request["attachment"]->store('attachment/debtor_pays', 'public');
        DebtorPayAttachment::create([
            'attachment' =>  $attachment_path,
            'debtor_pay_id' => $request->id,
            'title' => $request->title,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DebtorPayAttachment  $debtorPayAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(DebtorPayAttachment $debtorPayAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DebtorPayAttachment  $debtorPayAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(DebtorPayAttachment $debtorPayAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDebtorPayAttachmentRequest  $request
     * @param  \App\Models\DebtorPayAttachment  $debtorPayAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDebtorPayAttachmentRequest $request, DebtorPayAttachment $debtorPayAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DebtorPayAttachment  $debtorPayAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(DebtorPayAttachment $debtorPayAttachment)
    {
        Storage::delete("public/" . $debtorPayAttachment["attachment"]);
        $debtorPayAttachment->delete();

        return Redirect::back();
    }
}
