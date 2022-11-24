<?php

namespace App\Http\Controllers\People;

use App\Http\Controllers\Controller;
use App\Models\People\PeopleAttachment;
use App\Http\Requests\People\StorePeopleAttachmentRequest;
use App\Http\Requests\People\UpdatePeopleAttachmentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class PeopleAttachmentController extends Controller
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
            "attachment" => PeopleAttachment::with('user')->latest()->where('people_id', $file)->when(Request::input('search'), function ($query, $search) {
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
     * @param  \App\Http\Requests\StorePeopleAttachmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePeopleAttachmentRequest $request)
    {
        $attachment_path = $request["attachment"]->store('attachment/people', 'public');
        PeopleAttachment::create([
            'attachment' =>  $attachment_path,
            'people_id' => $request->id,
            'title' => $request->title,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PeopleAttachment  $peopleAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(PeopleAttachment $peopleAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PeopleAttachment  $peopleAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(PeopleAttachment $peopleAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePeopleAttachmentRequest  $request
     * @param  \App\Models\PeopleAttachment  $peopleAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePeopleAttachmentRequest $request, PeopleAttachment $peopleAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PeopleAttachment  $peopleAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(PeopleAttachment $peopleAttachment)
    {
        Storage::delete("public/" . $peopleAttachment["attachment"]);
        $peopleAttachment->delete();

        return Redirect::back();
    }
}
