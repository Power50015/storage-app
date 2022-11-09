<?php

namespace App\Http\Controllers\Creditor;

use App\Http\Controllers\Controller;
use App\Models\Creditor\CreditorAttachment;
use App\Http\Requests\Creditor\StoreCreditorAttachmentRequest;
use App\Http\Requests\Creditor\UpdateCreditorAttachmentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class CreditorAttachmentController extends Controller
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
            "attachment" => CreditorAttachment::with('user')->latest()->where('creditor_id', $file)->when(Request::input('search'), function ($query, $search) {
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
     * @param  \App\Http\Requests\StoreCreditorAttachmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCreditorAttachmentRequest $request)
    {
        $attachment_path = $request["attachment"]->store('attachment/creditor_pays', 'public');
        CreditorAttachment::create([
            'attachment' =>  $attachment_path,
            'creditor_id' => $request->id,
            'title' => $request->title,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CreditorAttachment  $creditorAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(CreditorAttachment $creditorAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CreditorAttachment  $creditorAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(CreditorAttachment $creditorAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCreditorAttachmentRequest  $request
     * @param  \App\Models\CreditorAttachment  $creditorAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCreditorAttachmentRequest $request, CreditorAttachment $creditorAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CreditorAttachment  $creditorAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(CreditorAttachment $creditorAttachment)
    {
        Storage::delete("public/" . $creditorAttachment["attachment"]);
        $creditorAttachment->delete();
        return Redirect::back();
    }
}
