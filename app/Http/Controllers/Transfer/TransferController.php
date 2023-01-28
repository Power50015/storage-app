<?php

namespace App\Http\Controllers\Transfer;

use App\Http\Controllers\Controller;
use App\Models\Transfer\Transfer;
use App\Http\Requests\Transfer\StoreTransferRequest;
use App\Http\Requests\Transfer\UpdateTransferRequest;
use App\Models\Driver\Driver;
use App\Models\Transfer\TransferAttachment;
use App\Models\Transfer\TransferContent;
use App\Models\Transfer\TransferKit;
use App\Models\Warehouse\Warehouse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Transfer/Index', [
            "transfer" => Transfer::with('user', 'warehouse_from', 'warehouse_to', 'driver')->orderBy('date', 'desc')->latest()->when(
                Request::input('search'),
                function ($query, $search) {
                    $query->where('number', 'like', "%{$search}%")
                        ->orWhere('date', 'like', "%{$search}%")
                        ->orWhereRelation('warehouse_from', 'name', 'like', "%{$search}%")
                        ->orWhereRelation('warehouse_to', 'name', 'like', "%{$search}%")
                        ->orWhereRelation('driver', 'name', 'like', "%{$search}%");
                }
            )->paginate(35)->withQueryString(),
            'filters' => Request::only(['search']),
            'totalTransfer' => Transfer::count(),
            'totalTransferThisDay' => Transfer::where('date', '>=', Carbon::now()->locale('eg')->toDateString())->count(),
            'totalTransferThisWeek' => Transfer::where('date', '>=', Carbon::now()->startOfWeek()->subWeek()->toDateString())->count(),
            'totalTransferThisMonth' => Transfer::where('date', '>=', Carbon::now()->startOfMonth()->subMonth()->toDateString())->count(),
            'totalTransferThisYear' => Transfer::where('date', '>=', Carbon::now()->startOfYear()->subMonth()->toDateString())->count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Transfer/Create', [
            "warehouses" => Warehouse::all(),
            "drivers" => Driver::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransferRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransferRequest $request)
    {
        // Save the Transfer
        $transfer = Transfer::create([
            'date' => $request->date,
            'driver_id' => $request->driver,
            'warehouse_from_id' => $request->warehouse_from_id,
            'warehouse_to_id' => $request->warehouse_to_id,
            'user_id' => Auth::id()
        ]);

        // Save The Content Of Transfer
        for ($i = 0; $i <  count($request["content"]); $i++) {
            TransferContent::create([
                'product_id' => $request["content"][$i]["product_id"],
                'quantity' => $request["content"][$i]["quantity"],
                'transfer_id' => $transfer['id'],
                'user_id' => Auth::id(),
                'warehouse_from_id' => $request->warehouse_from_id,
            'warehouse_to_id' => $request->warehouse_to_id,
            ]);
        }

        // Save The Content Of Transfer
        for ($i = 0; $i <  count($request["kit"]); $i++) {
            TransferKit::create([
                'kit_id' => $request["kit"][$i]["kit_id"],
                'quantity' => $request["kit"][$i]["quantity"],
                'transfer_id' => $transfer['id'],
                'user_id' => Auth::id(),
                'warehouse_from_id' => $request->warehouse_from_id,
            'warehouse_to_id' => $request->warehouse_to_id,
            ]);
        }

        return redirect()->route('transfer.show', $transfer['id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function show(Transfer $transfer)
    {
        return Inertia::render('Transfer/Show', [
            "transfer" => Transfer::where('id', $transfer->id)->with('user', 'warehouse_from', 'warehouse_to', 'driver')->get(),

            "transferContent" => TransferContent::with('product', 'product.product_country', 'product.product_material', 'product.product_color', 'product.product_model', 'product.product_collection', 'product.product_brand', 'product.product_type', 'product.product_category')->where('transfer_id', $transfer->id)->get(),

            "transferKit" => TransferKit::with('kit', 'kit.product', 'kit.product.product_country', 'kit.product.product_material', 'kit.product.product_color', 'kit.product.product_model', 'kit.product.product_collection', 'kit.product.product_brand', 'kit.product.product_type', 'kit.product.product_category')->where('transfer_id', $transfer->id)->get(),

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function edit(Transfer $transfer)
    {
        return Inertia::render('Transfer/Create', [
            "transfer" => Transfer::where('id', $transfer['id'])->get(),
            "transferContent" => TransferContent::where('transfer_id', $transfer['id'])->get(),
            "transferKit" => TransferKit::where('transfer_id', $transfer['id'])->get(),
            "warehouses" => Warehouse::all(),
            "drivers" => Driver::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransferRequest  $request
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransferRequest $request, Transfer $transfer)
    {
        $transfer->date = $request->date;
        $transfer->driver_id = $request->driver_id;
        $transfer->warehouse_from_id = $request->warehouse_from_id;
        $transfer->warehouse_to_id = $request->warehouse_to_id;
        $transfer->save();


        TransferContent::where('transfer_id', $transfer->id)->delete();
        TransferKit::where('transfer_id', $transfer->id)->delete();
        // Save The Content Of Transfer
        if (!is_null($request["content"]))
            for ($i = 0; $i <  count($request["content"]); $i++) {
                TransferContent::create([
                    'product_id' => $request["content"][$i]["product_id"],
                    'quantity' => $request["content"][$i]["quantity"],
                    'transfer_id' => $transfer['id'],
                    'user_id' => Auth::id(),
                    'warehouse_from_id' => $request->warehouse_from_id,
                    'warehouse_to_id' => $request->warehouse_to_id,
                ]);
            }
        // Save The Kit Of Transfer
        if (!is_null($request["kit"]))
            for ($i = 0; $i <  count($request["kit"]); $i++) {
                TransferKit::create([
                    'kit_id' => $request["kit"][$i]["kit_id"],
                    'quantity' => $request["kit"][$i]["quantity"],
                    'transfer_id' => $transfer['id'],
                    'user_id' => Auth::id(),
                    'warehouse_from_id' => $request->warehouse_from_id,
                    'warehouse_to_id' => $request->warehouse_to_id,
                ]);
            }

        return redirect()->route('transfer.show', $transfer['id']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transfer $transfer)
    {
        //
    }
}
