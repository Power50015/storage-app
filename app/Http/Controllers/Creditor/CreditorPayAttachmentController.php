<?php

namespace App\Http\Controllers\Creditor;

use App\Http\Controllers\Controller;
use App\Models\Creditor\CreditorPayAttachment;
use App\Http\Requests\Creditor\StoreCreditorPayAttachmentRequest;
use App\Http\Requests\Creditor\UpdateCreditorPayAttachmentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class CreditorPayAttachmentController extends Controller
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
            "attachment" => CreditorPayAttachment::with('user')->latest()->where('creditor_pay_id', $file)->when(Request::input('search'), function ($query, $search) {
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
     * @param  \App\Http\Requests\StoreCreditorPayAttachmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCreditorPayAttachmentRequest $request)
    {
        $attachment_path = $request["attachment"]->store('attachment/creditor_pays', 'public');
        CreditorPayAttachment::create([
            'attachment' =>  $attachment_path,
            'creditor_pay_id' => $request->id,
            'title' => $request->title,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CreditorPayAttachment  $creditorPayAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(CreditorPayAttachment $creditorPayAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CreditorPayAttachment  $creditorPayAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(CreditorPayAttachment $creditorPayAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCreditorPayAttachmentRequest  $request
     * @param  \App\Models\CreditorPayAttachment  $creditorPayAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCreditorPayAttachmentRequest $request, CreditorPayAttachment $creditorPayAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CreditorPayAttachment  $creditorPayAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(CreditorPayAttachment $creditorPayAttachment)
    {
        Storage::delete("public/" . $creditorPayAttachment["attachment"]);
        $creditorPayAttachment->delete();
        return Redirect::back();
    }
}
