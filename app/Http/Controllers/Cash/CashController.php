<?php

namespace App\Http\Controllers\Cash;

use App\Http\Controllers\Controller;
use App\Models\Cash\Cash;
use App\Http\Requests\Cash\StoreCashRequest;
use App\Http\Requests\Cash\UpdateCashRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;


class CashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Cash/Index', [
            "cash" =>  Cash::query()->with('user')->when(Request::input('search'), function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })->paginate()->withQueryString(),
            "totalCashes" => Cash::count(),
            'filters' => Request::only(['search'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Cash/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCashRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCashRequest $request)
    {
        $attachment_path = null;
        if ($request->hasFile('attachment')) {
            $attachment_path = $request->file('attachment')->store('attachment/cash', 'public');
        }
        Cash::create([
            'title' => $request->title,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function show(Cash $cash)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function edit(Cash $cash)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCashRequest  $request
     * @param  \App\Models\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCashRequest $request, Cash $cash)
    {
        $cash = Cash::find($cash["id"]);
        $cash->title = $request->title;
        $cash->save();
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cash $cash)
    {
        //
    }
}
