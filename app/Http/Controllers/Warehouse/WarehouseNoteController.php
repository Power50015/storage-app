<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\Warehouse\WarehouseNote;
use App\Http\Requests\Warehouse\StoreWarehouseNoteRequest;
use App\Http\Requests\Warehouse\UpdateWarehouseNoteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class WarehouseNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $note = Request::input('id');
        $search = Request::input('search');
        return [
            "note" => WarehouseNote::with('user')->latest()->where('warehouse_id', $note)->when(Request::input('search'), function ($query, $search) {
                $query->where('tag', 'like', "%{$search}%")
                    ->orWhere('note', 'like', "%{$search}%");
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
     * @param  \App\Http\Requests\StoreWarehouseNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWarehouseNoteRequest $request)
    {
        WarehouseNote::create([
            'note' => $request->note,
            'warehouse_id' => $request->id,
            'tag' => $request->tag,
            'user_id' => Auth::id()
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warehouse\WarehouseNote  $warehouseNote
     * @return \Illuminate\Http\Response
     */
    public function show(WarehouseNote $warehouseNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warehouse\WarehouseNote  $warehouseNote
     * @return \Illuminate\Http\Response
     */
    public function edit(WarehouseNote $warehouseNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWarehouseNoteRequest  $request
     * @param  \App\Models\Warehouse\WarehouseNote  $warehouseNote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWarehouseNoteRequest $request, WarehouseNote $warehouseNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warehouse\WarehouseNote  $warehouseNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(WarehouseNote $warehouseNote)
    {
        $warehouseNote->delete();

        return Redirect::back();
    }
}
