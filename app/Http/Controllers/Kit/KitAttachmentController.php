<?php

namespace App\Http\Controllers\Kit;

use App\Http\Controllers\Controller;
use App\Models\Kit\KitAttachment;
use App\Http\Requests\Kit\StoreKitAttachmentRequest;
use App\Http\Requests\Kit\UpdateKitAttachmentRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class KitAttachmentController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreKitAttachmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKitAttachmentRequest $request)
    {
        $attachment_path = $request["attachment"]->store('attachment/kits', 'public');
       KitAttachment::create([
            'attachment' =>  $attachment_path,
            'kit_id' => $request->kit_id,
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KitAttachment  $kitAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(KitAttachment $kitAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KitAttachment  $kitAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(KitAttachment $kitAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKitAttachmentRequest  $request
     * @param  \App\Models\KitAttachment  $kitAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKitAttachmentRequest $request, KitAttachment $kitAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KitAttachment  $kitAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(KitAttachment $kitAttachment)
    {
        $kitAttachment::destroy($kitAttachment->id);
        Storage::delete("public/" . $kitAttachment["attachment"]);
        return Redirect::back();
    }
}
