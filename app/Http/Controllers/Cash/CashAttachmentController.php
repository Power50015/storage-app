<?php

namespace App\Http\Controllers\Cash;

use App\Http\Controllers\Controller;
use App\Models\Cash\CashAttachment;
use App\Http\Requests\Cash\StoreCashAttachmentRequest;
use App\Http\Requests\Cash\UpdateCashAttachmentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class CashAttachmentController extends Controller
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
            "attachment" => CashAttachment::with('user')->latest()->where('cash_id', $file)->when(Request::input('search'), function ($query, $search) {
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
     * @param  \App\Http\Requests\StoreCashAttachmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCashAttachmentRequest $request)
    {
        $attachment_path = $request["attachment"]->store('attachment/cash', 'public');
        CashAttachment::create([
            'attachment' =>  $attachment_path,
            'cash_id' => $request->id,
            'title' => $request->title,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CashAttachment  $cashAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(CashAttachment $cashAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CashAttachment  $cashAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(CashAttachment $cashAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCashAttachmentRequest  $request
     * @param  \App\Models\CashAttachment  $cashAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCashAttachmentRequest $request, CashAttachment $cashAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashAttachment  $cashAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashAttachment $cashAttachment)
    {
        Storage::delete("public/" . $cashAttachment["attachment"]);
        $cashAttachment->delete();

        return Redirect::back();
    }
}
