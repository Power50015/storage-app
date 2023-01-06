<?php

namespace App\Http\Controllers\Transfer;

use App\Http\Controllers\Controller;
use App\Models\Transfer\TransferAttachment;
use App\Http\Requests\Transfer\StoreTransferAttachmentRequest;
use App\Http\Requests\Transfer\UpdateTransferAttachmentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class TransferAttachmentController extends Controller
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
            "attachment" => TransferAttachment::with('user')->latest()->where('transfer_id', $file)->when(Request::input('search'), function ($query, $search) {
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
     * @param  \App\Http\Requests\StoreTransferAttachmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransferAttachmentRequest $request)
    {
        $attachment_path = $request["attachment"]->store('attachment/transfer', 'public');
        TransferAttachment::create([
            'attachment' =>  $attachment_path,
            'transfer_id' => $request->id,
            'title' => $request->title,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransferAttachment  $transferAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(TransferAttachment $transferAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransferAttachment  $transferAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(TransferAttachment $transferAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransferAttachmentRequest  $request
     * @param  \App\Models\TransferAttachment  $transferAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransferAttachmentRequest $request, TransferAttachment $transferAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransferAttachment  $transferAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransferAttachment $transferAttachment)
    {
        Storage::delete("public/" . $transferAttachment["attachment"]);
        $transferAttachment->delete();

        return Redirect::back();
    }
}
