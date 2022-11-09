<?php

namespace App\Http\Controllers\Debtor;

use App\Http\Controllers\Controller;
use App\Models\Debtor\DebtorAttachment;
use App\Http\Requests\Debtor\StoreDebtorAttachmentRequest;
use App\Http\Requests\Debtor\UpdateDebtorAttachmentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class DebtorAttachmentController extends Controller
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
            "attachment" => DebtorAttachment::with('user')->latest()->where('debtor_id', $file)->when(Request::input('search'), function ($query, $search) {
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
     * @param  \App\Http\Requests\StoreDebtorAttachmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDebtorAttachmentRequest $request)
    {
        $attachment_path = $request["attachment"]->store('attachment/debtors', 'public');
        DebtorAttachment::create([
            'attachment' =>  $attachment_path,
            'debtor_id' => $request->id,
            'title' => $request->title,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DebtorAttachment  $debtorAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(DebtorAttachment $debtorAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DebtorAttachment  $debtorAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(DebtorAttachment $debtorAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDebtorAttachmentRequest  $request
     * @param  \App\Models\DebtorAttachment  $debtorAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDebtorAttachmentRequest $request, DebtorAttachment $debtorAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DebtorAttachment  $debtorAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(DebtorAttachment $debtorAttachment)
    {
        Storage::delete("public/" . $debtorAttachment["attachment"]);
        $debtorAttachment->delete();

        return Redirect::back();
    }
}
