<?php

namespace App\Http\Controllers\Cash;

use App\Http\Controllers\Controller;
use App\Models\Cash\CashPayAttachment;
use App\Http\Requests\Cash\StoreCashPayAttachmentRequest;
use App\Http\Requests\Cash\UpdateCashPayAttachmentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class CashPayAttachmentController extends Controller
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
            "attachment" => CashPayAttachment::with('user')->latest()->where('cash_pay_id', $file)->when(Request::input('search'), function ($query, $search) {
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
     * @param  \App\Http\Requests\StoreCashPayAttachmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCashPayAttachmentRequest $request)
    {
        $attachment_path = $request["attachment"]->store('attachment/cash_pay', 'public');
        CashPayAttachment::create([
            'attachment' =>  $attachment_path,
            'cash_pay_id' => $request->id,
            'title' => $request->title,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CashPayAttachment  $cashPayAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(CashPayAttachment $cashPayAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CashPayAttachment  $cashPayAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(CashPayAttachment $cashPayAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCashPayAttachmentRequest  $request
     * @param  \App\Models\CashPayAttachment  $cashPayAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCashPayAttachmentRequest $request, CashPayAttachment $cashPayAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashPayAttachment  $cashPayAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashPayAttachment $cashPayAttachment)
    {
        Storage::delete("public/" . $cashPayAttachment["attachment"]);
        $cashPayAttachment->delete();

        return Redirect::back();
    }
}
